<template>
    <v-container fluid grid-list-md>
        <template v-if="!loadingTrack">
            <v-layout row wrap>
                <v-flex xs12>
                    <v-toolbar color="grey darken-4">
                        <v-toolbar-title>{{track.name}}</v-toolbar-title>
                    </v-toolbar>
                </v-flex>
            </v-layout>

            <v-layout row wrap>
                <v-flex md6 xs12>
                    <v-card>
                        <v-toolbar color="grey darken-4">
                            <v-toolbar-title>Layout</v-toolbar-title>
                        </v-toolbar>
                        <v-img alt="" :src="track.image" class="" style="max-width: 100%;"></v-img>
                    </v-card>
                </v-flex>

                <v-flex md6 xs12>
                    <v-card>
                        <v-toolbar color="grey darken-4">
                            <v-toolbar-title>Info</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-list two-line shaped>
                                <v-divider></v-divider>
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-information-variant</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>Name</v-list-item-title>
                                        <v-list-item-subtitle>{{ track.name }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-ruler</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>Length</v-list-item-title>
                                        <v-list-item-subtitle>{{ track.length }}mi / {{ (track.length * 1.60934).toFixed(2) }}km</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-undo-variant</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>Corners</v-list-item-title>
                                        <v-list-item-subtitle>{{ track.number_of_corners }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                                <v-list-item :href="track.website" target="_blank">
                                    <v-list-item-icon>
                                        <v-icon>web</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>Website</v-list-item-title>
                                        <v-list-item-subtitle>{{ track.website }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
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
                    <race-card :race="race" :title="race.season.name + ' ' + race.name"></race-card>
                </v-flex>
            </template>
            <template v-if="loadingTrack">
                <v-progress-circular indeterminate v-bind:size="70" v-bind:width="7" color="primary"></v-progress-circular>
            </template>
        </v-layout>
    </v-container>
</template>


<script>
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
                this.$axios.get('/api/track/' + this.$route.params.id)
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