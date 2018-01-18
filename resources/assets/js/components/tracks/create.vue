<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex lg8 offset-lg2 xs12>
                <v-card>
                    <v-toolbar>
                        <v-toolbar-title>Create Track</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field
                                label="Name"
                                v-model="name"
                                prepend-icon="mdi-rename-box"
                        ></v-text-field>
                        <v-text-field
                                label="Length in mi"
                                v-model="length"
                                prepend-icon="mdi-ruler"
                                type="number"
                        ></v-text-field>
                        <v-text-field
                                label="Image"
                                v-model="image"
                                prepend-icon="mdi-image"
                        ></v-text-field>
                        <v-text-field
                                label="Website"
                                v-model="website"
                                prepend-icon="web"
                        ></v-text-field>
                        <v-text-field
                                label="Number of corners"
                                v-model="numberOfCorners"
                                prepend-icon="mdi-undo-variant"
                                type="number"
                        ></v-text-field>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-btn
                                outline
                                color="primary"
                                @click="createTrack()"
                        ><v-icon left dark>mdi-library-plus</v-icon>Create</v-btn>
                        <v-btn
                                outline
                                color="info"
                                @click="clear()"
                        ><v-icon left dark>mdi-close-box-outline</v-icon>Clear</v-btn>
                    </v-card-text>
                </v-card>
                <v-snackbar
                        :timeout="timeout"
                        v-model="success"
                        :top="true"
                        :right="true"
                        class="green"
                >
                    {{newTrack.name}} added!
                </v-snackbar>

                <v-snackbar
                        :timeout="timeout"
                        v-model="errors"
                        :top="true"
                        :right="true"
                        class="red"
                >
                    Error
                </v-snackbar>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                name: null,
                length: null,
                image: null,
                website: null,
                loadingTracks: true,
                loadingSeries: true,
                loadingSeasons: true,
                selectedTrackID: null,
                numberOfCorners: null,
                newTrack: {},
                modal: false,
                success: false,
                errors: false,
                timeout: 5000
            }
        },
        methods: {
            createTrack: function () {
                axios.post('/api/track', {
                    name: this.name,
                    length: this.length,
                    image: this.image,
                    website: this.website,
                    numberOfCorners: this.numberOfCorners
                })
                    .then((response) => {
                        this.newTrack = response.data;
                        this.success = true;
                        this.clear();
                    })
                    .catch((e) => {
                        this.errors = true;
                        console.log(e);
                    });
            },
            clear: function () {
                this.name = null;
                this.length = null;
                this.image = null;
                this.website = null;
                this.numberOfCorners = null;
            }
        }
    }
</script>