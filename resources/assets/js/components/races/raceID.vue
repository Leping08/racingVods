<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <template v-if="!loadingRace">
                <v-flex xs12>
                    <race-toolbar :race="race"></race-toolbar>
                </v-flex>
                <v-flex xs12>
                    <v-stepper v-model="selected">
                        <v-stepper-header v-if="race.videos.length > 1">
                            <template v-for="(vod, index) in race.videos">
                                <v-stepper-step :step="index+1" :complete="index+1 < selected">Part {{index+1}}</v-stepper-step>
                                <v-divider v-if="race.videos.length != index+1"></v-divider>
                            </template>
                        </v-stepper-header>
                        <v-stepper-items>
                            <v-stepper-content :step="index+1" v-for="(vod, index) in race.videos" :key="vod.id">
                                <template v-if="selected === (index + 1)">
                                    <v-layout row wrap>
                                        <v-flex xs12>
                                            <youtube :video-id="vod.youtube_id" :ref="'video'+(index)" :resize="true" :fit-parent="true"></youtube>
                                        </v-flex>
                                    </v-layout>
                                </template>

                                <div class="d-flex justify-space-between mt-2">
                                    <div>
                                        <div v-if="race.videos.length > 1">
                                            <template v-if="selected > 1">
                                                <v-tooltip top>
                                                    <template v-slot:activator="{ on }">
                                                        <v-btn outlined small fab v-on="on" @click="selected--">
                                                            <v-icon>mdi-chevron-left</v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <span>Last Part</span>
                                                </v-tooltip>
                                            </template>
                                            <template v-else>
                                                <v-btn outlined small fab disabled>
                                                    <v-icon>mdi-chevron-left</v-icon>
                                                </v-btn>
                                            </template>
                                        </div>
                                    </div>

                                    <div>
                                        <template v-if="(selected <= 1) || (vod.youtube_start_time > 0)">
                                            <v-tooltip top>
                                                <template v-slot:activator="{ on }">
                                                    <v-btn outlined small fab color="primary" v-on="on" @click="start(index, vod.youtube_start_time)">
                                                        <v-icon>mdi-clock-start</v-icon>
                                                    </v-btn>
                                                </template>
                                                <span>Race Start</span>
                                            </v-tooltip>
                                        </template>
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on }">
                                                <v-btn outlined small fab color="primary" v-on="on" @click="play(index)">
                                                    <v-icon>mdi-play</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Play</span>
                                        </v-tooltip>
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on }">
                                                <v-btn outlined small fab color="primary" v-on="on" @click="pause(index)">
                                                    <v-icon>mdi-pause</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Pause</span>
                                        </v-tooltip>
                                    </div>

                                    <div>
                                        <div v-if="race.videos.length > 1">
                                            <template v-if="!(selected === race.videos.length)">
                                                <v-tooltip top>
                                                    <template v-slot:activator="{ on }">
                                                        <v-btn outlined small fab v-on="on" @click="selected++">
                                                            <v-icon>mdi-chevron-right</v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <span>Next Part</span>
                                                </v-tooltip>
                                            </template>
                                            <template v-else>
                                                <v-btn outlined small fab disabled>
                                                    <v-icon>mdi-chevron-right</v-icon>
                                                </v-btn>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </v-stepper-content>
                        </v-stepper-items>
                    </v-stepper>
                </v-flex>
                <v-flex md6 s12>
                    <v-card>
                        <v-toolbar color="grey darken-4">
                            <v-toolbar-title>Race</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon color="primary">mdi-flag-checkered</v-icon>
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
                                        <v-list-item-subtitle>{{ race.name }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-timer</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>Duration</v-list-item-title>
                                        <v-list-item-subtitle>{{ race.duration }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-calendar</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>Date</v-list-item-title>
                                        <v-list-item-subtitle>{{ race.race_date | moment("M/D/YYYY") }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex md6 s12>
                    <v-card>
                        <v-toolbar color="grey darken-4">
                            <v-toolbar-title>Series</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon color="primary">mdi-format-list-bulleted</v-icon>
                        </v-toolbar>
                        <v-card-text>
                            <v-list two-line shaped>
                                <v-divider></v-divider>
                                <v-list-item :to="'/series/'+race.series.id">
                                    <v-list-item-icon>
                                        <v-icon>mdi-information-variant</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>Name</v-list-item-title>
                                        <v-list-item-subtitle>{{ race.series.full_name }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                                <v-list-item :to="'/races/series/'+race.series.id+'/season/'+race.season.id">
                                    <v-list-item-icon>
                                        <v-icon>mdi-calendar-clock</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>Season</v-list-item-title>
                                        <v-list-item-subtitle>{{ race.season.name }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                                <v-list-item :href="race.series.website" target="_blank">
                                    <v-list-item-icon>
                                        <v-icon>web</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>Website</v-list-item-title>
                                        <v-list-item-subtitle>{{ race.series.website }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex xs12>
                    <v-card>
                        <v-toolbar color="grey darken-4">
                            <v-toolbar-title>Track</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon color="primary">mdi-road</v-icon>
                        </v-toolbar>
                        <v-card-text>
                            <v-layout row wrap>
                                <v-flex md6 xs12>
                                    <v-img :src="race.track.image" style="max-width:100%;"></v-img>
                                </v-flex>
                                <v-flex md6 xs12>
                                    <v-list two-line shaped>
                                        <v-divider></v-divider>
                                        <v-list-item :to="'/tracks/'+race.track.id">
                                            <v-list-item-icon>
                                                <v-icon>mdi-information-variant</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-title>Name</v-list-item-title>
                                                <v-list-item-subtitle>{{ race.track.name }}</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                        <v-divider></v-divider>
                                        <v-list-item>
                                            <v-list-item-icon>
                                                <v-icon>mdi-ruler</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-title>Length</v-list-item-title>
                                                <v-list-item-subtitle>{{ race.track.length }}mi / {{ (race.track.length * 1.60934).toFixed(2) }}km</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                        <v-divider></v-divider>
                                        <v-list-item>
                                            <v-list-item-icon>
                                                <v-icon>mdi-undo-variant</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-title>Corners</v-list-item-title>
                                                <v-list-item-subtitle>{{ race.track.number_of_corners }}</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                        <v-divider></v-divider>
                                        <v-list-item :href="race.track.website" target="_blank">
                                            <v-list-item-icon>
                                                <v-icon>web</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-title>Website</v-list-item-title>
                                                <v-list-item-subtitle>{{ race.track.website }}</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                        <v-divider></v-divider>
                                    </v-list>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex xs12>
                    <v-card>
                        <v-toolbar color="grey darken-4">
                            <v-toolbar-title>Schedule</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon color="primary">mdi-calendar-range</v-icon>
                        </v-toolbar>

<!--                        <v-list-item-group ripple exact color="primary">-->
<!--                            <v-list-item>-->
<!--                                <v-list-item-icon>-->
<!--                                    <v-icon>mdi-calendar-range</v-icon>-->
<!--                                </v-list-item-icon>-->
<!--                                <v-list-item-content>-->
<!--                                    <v-list-item-title>Schedule</v-list-item-title>-->
<!--                                </v-list-item-content>-->
<!--                            </v-list-item>-->
<!--                        </v-list-item-group>-->

                        <v-card-text>
                            <v-list two-line shaped>
                                <template v-for="(seasonRace, index) in seasonRaces" @key="seasonRace.id">
                                    <v-divider></v-divider>
                                    <v-list-item-group link ripple exact color="primary">
                                        <v-list-item :to="'/races/'+seasonRace.id" :key="seasonRace.id">
                                            <v-list-item-content>
                                                <v-list-item-title>{{index+1}}. {{ seasonRace.name }}</v-list-item-title>
                                                <v-list-item-subtitle>{{ seasonRace.track.name }}</v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list-item-group>
                                </template>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </template>
            <template v-if="loadingRace">
                <v-progress-circular indeterminate v-bind:size="70" v-bind:width="7" color="primary"></v-progress-circular>
            </template>
        </v-layout>
    </v-container>
</template>


<script>
    import youtube from 'vue-youtube'
    import RaceToolbar from "../utilitys/race-toolbar";
    export default {
        components: {RaceToolbar},
        data () {
            return {
                race: [],
                seasonRaces: [],
                loadingRace: true,
                loadingSeasonRaces: true,
                player: {},
                selected: 1
            }
        },
        comments: {
            youtube
        },
        mounted() {
            this.getRace();
        },
        methods: {
            getRace: function () {
                this.$axios.get('/api/race/' + this.$route.params.id)
                    .then((response) => {
                        this.race = response.data;
                        this.loadingRace = false;
                        this.getSeason(this.race.season.id, this.race.series.id)
                    })
                    .catch((e) => {
                        this.loadingRace = false;
                        console.log(e);
                    });
            },
            getSeason: function (seasonID, seriesID) {
                this.$axios.get('/api/series/' + seriesID + '/season/' + seasonID)
                    .then((response) => {
                        this.seasonRaces = response.data;
                        this.loadingSeasonRaces = false;
                    })
                    .catch((e) => {
                        this.loadingSeasonRaces = false;
                        console.log(e);
                    });
            },
            play: function(index) {
                console.log(this.$refs.yeet);
                this.$refs['video'+(index)][0].player.playVideo();
            },
            pause: function(index) {
                this.$refs['video'+(index)][0].player.pauseVideo();
            },
            start: function(index, start) {
                this.$refs['video'+(index)][0].player.seekTo(start);
                this.play(index);
            }
        }
    }
</script>
