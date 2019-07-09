<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs12>
                <v-stepper v-model="step">
                    <v-stepper-header>
                        <v-stepper-step step="1" :complete="step > 1">Select Series</v-stepper-step>
                        <v-divider></v-divider>
                        <v-stepper-step step="2" :complete="step > 2">Select Season</v-stepper-step>
                        <v-divider></v-divider>
                        <v-stepper-step step="3" :complete="step > 3">Select Race</v-stepper-step>
                        <v-divider></v-divider>
                        <v-stepper-step step="4" :complete="step > 4">Add Video</v-stepper-step>
                    </v-stepper-header>
                    <v-stepper-items>
                        <v-stepper-content step="1">
                            <v-select
                                    v-bind:items="series"
                                    item-text="fullName"
                                    item-value="id"
                                    v-model="series_id"
                                    label="Series"
                                    :loading="loadingSeries"
                                    single-line
                                    bottom
                                    autocomplete
                                    prepend-icon="mdi-format-list-bulleted"
                            ></v-select>
                            <v-btn color="primary" @click="step++; getSeasons();" :disabled="!series_id">Continue</v-btn>
                        </v-stepper-content>
                        <v-stepper-content step="2">
                            <v-select
                                    v-bind:items="seasons"
                                    item-text="name"
                                    item-value="id"
                                    v-model="season_id"
                                    label="Season"
                                    :loading="loadingSeasons"
                                    single-line
                                    bottom
                                    autocomplete
                                    prepend-icon="mdi-weather-sunset"
                            ></v-select>
                            <v-btn color="primary" @click="step++; getRaces();" :disabled="!season_id">Continue</v-btn>
                            <v-btn @click="step--" flat>Back</v-btn>
                        </v-stepper-content>
                        <v-stepper-content step="3">
                            <v-select
                                    v-bind:items="races"
                                    item-text="name"
                                    item-value="id"
                                    v-model="race_id"
                                    label="Race"
                                    :loading="loadingRaces"
                                    single-line
                                    bottom
                                    autocomplete
                                    prepend-icon="mdi-flag-checkered"
                            ></v-select>
                            <v-btn color="primary" @click="step++; getVideos();" :disabled="!race_id">Continue</v-btn>
                            <v-btn @click="step--" flat>Back</v-btn>
                        </v-stepper-content>
                        <v-stepper-content step="4">
                            <v-carousel v-if="!loadingRace">
                                <template v-for="(vod, index) in race.videos" @key="vod.id">
                                    <v-carousel-item :src="'https://img.youtube.com/vi/'+vod.youtube_id+'/hqdefault.jpg'" style="text-decoration: none !important;">
                                        <v-toolbar>
                                            <v-toolbar-title>Part {{index+1}}</v-toolbar-title>
                                        </v-toolbar>
                                    </v-carousel-item>
                                </template>
                            </v-carousel>

                            <v-divider></v-divider>

                            <v-toolbar class="mt-3">
                                <v-toolbar-title>Add Video</v-toolbar-title>
                            </v-toolbar>
                            <v-card>
                                <v-card-text>
                                    <v-text-field
                                            label="Youtube ID"
                                            v-model="youtube_id"
                                            prepend-icon="mdi-message-video"
                                    ></v-text-field>
                                    <v-text-field
                                            label="Start Time (Seconds)"
                                            v-model="youtube_start_time"
                                            prepend-icon="mdi-timer"
                                    ></v-text-field>

                                    <v-btn color="primary" @click="step++; addVideo()">Add Video</v-btn>
                                    <v-btn @click="step--" flat>Back</v-btn>
                                </v-card-text>
                            </v-card>
                        </v-stepper-content>
                    </v-stepper-items>
                </v-stepper>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "create",
        data() {
            return {
                step: 1,
                series_id: null,
                season_id: null,
                race_id: null,
                loadingSeries: false,
                loadingSeasons: false,
                loadingRaces: false,
                loadingRace: false,
                series: [],
                seasons: [],
                races: [],
                race: [],
                youtube_id: '',
                youtube_start_time: 0

            }
        },
        mounted() {
            this.getSeries()
        },
        methods: {
            getSeries: function () {
                this.loadingSeries = true;
                this.series = [];
                this.$axios.get('/api/series')
                    .then((response) => {
                        this.series = response.data;
                        this.loadingSeries = false;
                    })
                    .catch((e) => {
                        this.loadingSeries = false;
                        console.log(e);
                    });
            },
            getSeasons: function () {
                this.loadingSeasons = true;
                this.seasons = [];
                this.$axios.get('/api/seasons')
                    .then((response) => {
                        this.seasons = response.data;
                        this.loadingSeasons = false;
                    })
                    .catch((e) => {
                        this.loadingSeasons = false;
                        console.log(e);
                    });
            },
            getRaces: function () {
                this.loadingRaces = true;
                this.races = [];
                this.$axios.get('/api/series/'+ this.series_id + '/season/' + this.season_id)
                    .then((response) => {
                        this.races = response.data;
                        this.loadingRaces = false;
                    })
                    .catch((e) => {
                        this.loadingRaces = false;
                        console.log(e);
                    });
            },
            getVideos: function () {
                this.loadingRace = true;
                this.race = [];
                this.$axios.get('/api/race/' + this.race_id)
                    .then((response) => {
                        this.race = response.data;
                        this.loadingRace = false;
                    })
                    .catch((e) => {
                        this.loadingRace = false;
                        console.log(e);
                    });
            },
            addVideo: function () {
                this.$axios.post('/api/video', {
                    race_id: this.race_id,
                    youtube_id: this.youtube_id,
                    youtube_start_time: this.youtube_start_time
                })
                    .then((response) => {
                        window.flash('Video added!', 'green');
                        this.step = 3;
                    })
                    .catch((e) => {
                        window.flash('Error', 'red');
                        console.log(e);
                    });
            }
        }
    }
</script>