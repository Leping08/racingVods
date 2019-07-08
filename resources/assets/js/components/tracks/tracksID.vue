<template>
    <v-container fluid grid-list-md>
        <template v-if="!loadingTrack">
            <v-layout row wrap>
                <v-flex xs12>
                    <v-toolbar>
                        <v-toolbar-title>{{track.name}}</v-toolbar-title>
                    </v-toolbar>
                </v-flex>
            </v-layout>

            <v-layout row wrap>
                <v-flex md6 xs12 d-flex>
                    <v-card>
                        <v-toolbar>
                            <v-toolbar-title>Layout</v-toolbar-title>
                        </v-toolbar>
                        <img :src="track.image" class="" style="max-width: 100%;">
                    </v-card>
                </v-flex>

                <v-flex md6 xs12 d-flex>
                    <v-card>
                        <v-toolbar>
                            <v-toolbar-title>Info</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-list two-line>
                                <v-divider></v-divider>
                                <v-list-tile>
                                    <v-list-tile-avatar>
                                        <v-icon>mdi-information-variant</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Name</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ track.name }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                                <v-list-tile>
                                    <v-list-tile-avatar>
                                        <v-icon>mdi-ruler</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Length</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ track.length }}mi / {{ (track.length * 1.60934).toFixed(2) }}km</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                                <v-list-tile>
                                    <v-list-tile-avatar>
                                        <v-icon>mdi-undo-variant</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Corners</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ track.number_of_corners }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                                <v-list-tile :href="track.website" target="_blank">
                                    <v-list-tile-avatar>
                                        <v-icon>web</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Website</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ track.website }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </template>
        <template v-if="loadingTrack">
            <v-progress-circular indeterminate v-bind:size="70" v-bind:width="7" color="primary"></v-progress-circular>
        </template>

        <v-layout row wrap>
            <template v-for="race in track.races" @key="race.id" v-if="!loadingTrack">
                <v-flex lg4 md6 xs12>
                    <race-card :race="race"></race-card>
                </v-flex>
            </template>
            <template v-if="loadingTrack">
                <v-progress-circular indeterminate v-bind:size="70" v-bind:width="7" color="primary"></v-progress-circular>
            </template>
        </v-layout>
    </v-container>
</template>


<script>
    import axios from 'axios';
    import RaceCard from "../utilitys/race-card";
    export default {
        components: {RaceCard},
        data() {
            return {
                track: [],
                loadingTrack: true
            }
        },
        mounted() {
            this.getTrack();
        },
        methods: {
            getTrack: function () {
                axios.get('/api/track/' + this.$route.params.id)
                    .then((response) => {
                        this.track = response.data;
                        this.loadingTrack = false;
                    })
                    .catch((e) => {
                        this.loadingTrack = false;
                        console.log(e);
                    });
            }
        }
    }
</script>