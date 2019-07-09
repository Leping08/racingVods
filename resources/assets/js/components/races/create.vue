<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex lg8 offset-lg2 xs12>
                <v-card>
                    <v-toolbar>
                        <v-toolbar-title>Create Race</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field
                                label="Name"
                                v-model="name"
                                prepend-icon="mdi-rename-box"
                        ></v-text-field>
                        <v-select
                                v-bind:items="tracks"
                                item-text="name"
                                item-value="id"
                                v-model="track_id"
                                label="Track"
                                :loading="loadingTracks"
                                single-line
                                bottom
                                autocomplete
                                prepend-icon="mdi-road"
                        ></v-select>
                        <v-select
                                v-bind:items="series"
                                item-text="full_name"
                                item-value="id"
                                v-model="series_id"
                                label="Series"
                                :loading="loadingSeries"
                                single-line
                                bottom
                                autocomplete
                                prepend-icon="mdi-format-list-bulleted"
                        ></v-select>
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


                        <v-menu
                                ref="menu"
                                lazy
                                :close-on-content-click="false"
                                v-model="menu"
                                transition="scale-transition"
                                offset-y
                                full-width
                                :nudge-right="40"
                                min-width="290px"
                                :return-value.sync="race_date"
                        >
                            <v-text-field
                                    slot="activator"
                                    label="Race Date"
                                    v-model="race_date"
                                    prepend-icon="event"
                                    readonly
                            ></v-text-field>
                            <v-date-picker v-model="race_date" color="primary">
                                <v-spacer></v-spacer>
                                <v-btn flat color="primary" @click="menu = false">Cancel</v-btn>
                                <v-btn flat color="primary" @click="$refs.menu.save(race_date)">OK</v-btn>
                            </v-date-picker>
                        </v-menu>


                        <!--<v-dialog-->
                                <!--ref="dialog"-->
                                <!--persistent-->
                                <!--v-model="modal"-->
                                <!--lazy-->
                                <!--full-width-->
                                <!--width="290px"-->
                                <!--:return-value.sync="race_date"-->
                        <!--&gt;-->
                            <!--<v-text-field-->
                                    <!--slot="activator"-->
                                    <!--label="Picker in dialog"-->
                                    <!--v-model="race_date"-->
                                    <!--prepend-icon="event"-->
                                    <!--readonly-->
                            <!--&gt;</v-text-field>-->
                            <!--<v-date-picker v-model="race_date" color="primary">-->
                                <!--<v-spacer></v-spacer>-->
                                <!--<v-btn flat color="primary" @click="modal = false">Cancel</v-btn>-->
                                <!--<v-btn flat color="primary" @click="$refs.dialog.save(race_date)">OK</v-btn>-->
                            <!--</v-date-picker>-->
                        <!--</v-dialog>-->
                        <v-text-field
                                label="Duration"
                                v-model="duration"
                                prepend-icon="mdi-timer"
                        ></v-text-field>
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
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-btn
                                outline
                                color="primary"
                                @click="createRace()"
                        ><v-icon left dark>mdi-library-plus</v-icon>Create</v-btn>
                        <v-btn
                                outline
                                color="info"
                                @click="clear()"
                        ><v-icon left dark>mdi-close-box-outline</v-icon>Clear</v-btn>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                tracks: [],
                series: [],
                seasons: [],
                loadingTracks: true,
                loadingSeries: true,
                loadingSeasons: true,
                selectedTrackID: null,
                name: null,
                series_id: null,
                track_id: null,
                season_id: null,
                race_date: null,
                youtube_id: null,
                youtube_start_time: null,
                duration: null,
                modal: false,
                menu: false,
                newRace: {}
            }
        },
        mounted() {
            this.getTracks();
            this.getSeries();
            this.getSeasons();
        },
        methods: {
            getTracks: function () {
                this.loadingTracks = true;
                this.tracks = [];
                this.$axios.get('/api/tracks')
                    .then((response) => {
                        this.tracks = response.data;
                        this.loadingTracks = false;
                    })
                    .catch((e) => {
                        this.loadingTracks = false;
                        console.log(e);
                    });
            },
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
            createRace: function () {
                this.$api.post('/api/race', {
                        name: this.name,
                        series_id: this.series_id,
                        track_id: this.track_id,
                        season_id: this.season_id,
                        race_date: this.race_date,
                        youtube_id: this.youtube_id,
                        youtube_start_time: this.youtube_start_time,
                        duration: this.duration
                    })
                    .then((response) => {
                        this.newRace = response.data;
                        window.flash(this.newRace.name + ' added', 'green');
                        this.partialClear();
                    })
                    .catch((e) => {
                        window.flash('Error', 'red');
                        console.log(e);
                    });
            },
            clear: function () {
                this.name = null;
                this.series_id = null;
                this.track_id = null;
                this.season_id = null;
                this.race_date = null;
                this.youtube_id = null;
                this.youtube_start_time = null;
                this.duration = null;
            },
            partialClear: function () {
                this.name = null;
                this.track_id = null;
                this.race_date = null;
                this.youtube_id = null;
                this.youtube_start_time = null;
                this.duration = null;
            }
        }
    }
</script>