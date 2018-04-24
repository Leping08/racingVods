<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs12 sm8 offset-sm2>
                <v-card>
                    <v-toolbar color="" dark>
                        <v-toolbar-title>Login</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon>
                            <v-icon color="primary">mdi-lock</v-icon>
                        </v-btn>
                    </v-toolbar>
                    <v-card-text>
                        <v-form v-model="valid" ref="form" lazy-validation>
                            <v-text-field
                                    label="E-mail"
                                    v-model="email"
                                    :rules="emailRules"
                                    required
                            ></v-text-field>
                            <v-text-field
                                    label="Enter your password"
                                    v-model="password"
                                    @keyup.enter="login"
                                    :append-icon="e1 ? 'visibility' : 'visibility_off'"
                                    :append-icon-cb="() => (e1 = !e1)"
                                    :type="e1 ? 'password' : 'text'"
                                    :rules="[v => !!v || 'Password is required']"
                                    counter
                            ></v-text-field>
                            <v-btn
                                    @click="login"
                                    :disabled="!valid"
                            >
                                submit
                            </v-btn>
                            <v-btn @click="clear">clear</v-btn>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>


<script>
    export default {
        data () {
            return {
                password: '',
                e1: true,
                valid: true,
                email: '',
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
                ]
            }
        },
        methods: {
            login: function () {
                let data = {
                    client_id: 2,
                    client_secret: 'uc3Bb5BDNpxc4pQLG0jOr00scej6E7p9WL9cCkL6',
                    grant_type: 'password',
                    username: this.email,
                    password: this.password
                };
                axios.post('/oauth/token', data)
                    .then((response) => {
                        window.setAccessToken(response.data.access_token);
                        this.$store.dispatch('authCheck');
                        this.$emit()
                        this.$router.push('/dashboard');
                    })
                    .catch((e) => {
                        window.flash('Invalid Credentials', 'red');
                        console.log(e);
                    });
            },
            clear: function () {
                this.email = '';
                this.password = '';
            }
        }
    }
</script>
