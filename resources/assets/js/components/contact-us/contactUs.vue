<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex lg8 offset-lg2 md8 offset-md2 xs12>
                <v-card>
                    <v-toolbar>
                        <v-toolbar-title>
                            Contact Us
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-icon color="primary">mdi-message-text-outline</v-icon>
                    </v-toolbar>
                    <v-card-text>
                        <v-form
                                ref="form"
                                v-model="valid"
                                lazy-validation
                        >
                            <v-text-field
                                    v-model="name"
                                    :rules="nameRules"
                                    label="Name"
                                    required
                            ></v-text-field>
                            <v-text-field
                                    v-model="email"
                                    :rules="emailRules"
                                    label="E-mail"
                                    required
                            ></v-text-field>
                            <v-textarea
                                    v-model="message"
                                    :rules="messageRules"
                                    required
                            >
                                <template v-slot:label>
                                    <div>
                                        Message
                                    </div>
                                </template>
                            </v-textarea>

                            <v-btn
                                    outline
                                    round
                                    color="teal"
                                    :disabled="!valid"
                                    @click="submit"
                            >Submit</v-btn>
                            <v-btn
                                    @click="clear"
                                    outline
                                    round
                                    color="grey"
                            >clear</v-btn>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "ContactUs",
        data() {
            return {
                valid: true,
                name: '',
                nameRules: [
                    v => !!v || 'Name is required'
                ],
                email: '',
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'E-mail must be valid'
                ],
                message: '',
                messageRules: [
                    v => !!v || 'Message is required',
                ]
            }
        },
        methods: {
            clear () {
                this.$refs.form.reset();
            },
            submit () {
                if(this.$refs.form.validate()){
                    this.sendMessage();
                }
            },
            sendMessage () {
                this.$axios.post('/api/contact-us', {
                        'name': this.name,
                        'email': this.email,
                        'message': this.message
                    })
                    .then((response) => {
                        this.clear();
                        window.flash('Message Sent!', 'green');
                    })
                    .catch((error) => {
                        window.flash('Looks like something went wrong. We are looking into it.', 'red');
                        console.log(error);
                    });
            }
        }
    }
</script>
