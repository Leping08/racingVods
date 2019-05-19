<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <template v-if="!loadingRace">
                <v-flex xs12>
                    <v-toolbar>
                        <v-toolbar-title>{{race.name}}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-icon
                                v-if="race.new"
                                color="primary"
                        >
                            mdi-new-box
                        </v-icon>
                    </v-toolbar>
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
                                <v-layout align-center justify-center row fill-height class="mt-3">
                                    <template v-if="race.videos.length > 1">
                                        <template v-if="selected > 1">
                                            <v-tooltip top>
                                                <template v-slot:activator="{ on }">
                                                    <v-btn outline small fab v-on="on" @click="selected--">
                                                        <v-icon>mdi-chevron-left</v-icon>
                                                    </v-btn>
                                                </template>
                                                <span>Last Part</span>
                                            </v-tooltip>
                                        </template>
                                        <template v-else>
                                            <v-btn outline small fab disabled>
                                                <v-icon>mdi-chevron-left</v-icon>
                                            </v-btn>
                                        </template>
                                    </template>

                                    <v-spacer></v-spacer>

                                    <div>
                                        <template v-if="selected <= 1">
                                            <v-tooltip top>
                                                <template v-slot:activator="{ on }">
                                                    <v-btn outline small fab color="teal" v-on="on" @click="start(index, vod.youtube_start_time)">
                                                        <v-icon>mdi-clock-start</v-icon>
                                                    </v-btn>
                                                </template>
                                                <span>Race Start</span>
                                            </v-tooltip>
                                        </template>
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on }">
                                                <v-btn outline small fab color="teal" v-on="on" @click="play(index)">
                                                    <v-icon>mdi-play</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Play</span>
                                        </v-tooltip>
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on }">
                                                <v-btn outline small fab color="teal" v-on="on" @click="pause(index)">
                                                    <v-icon>mdi-stop</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Pause</span>
                                        </v-tooltip>
                                    </div>

                                    <v-spacer></v-spacer>

                                    <template v-if="race.videos.length > 1">
                                        <template v-if="!(selected === race.videos.length)">
                                            <v-tooltip top>
                                                <template v-slot:activator="{ on }">
                                                    <v-btn outline small fab v-on="on" @click="selected++">
                                                        <v-icon>mdi-chevron-right</v-icon>
                                                    </v-btn>
                                                </template>
                                                <span>Next Part</span>
                                            </v-tooltip>
                                        </template>
                                        <template v-else>
                                            <v-btn outline small fab disabled>
                                                <v-icon>mdi-chevron-right</v-icon>
                                            </v-btn>
                                        </template>
                                    </template>
                                </v-layout>
                            </v-stepper-content>
                        </v-stepper-items>
                    </v-stepper>
                </v-flex>
                <v-flex md6 s12>
                    <v-card>
                        <v-toolbar>
                            <v-toolbar-title>Race</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon color="primary">mdi-flag-checkered</v-icon>
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
                                        <v-list-tile-sub-title>{{ race.name }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                                <v-list-tile>
                                    <v-list-tile-avatar>
                                        <v-icon>mdi-timer</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Duration</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ race.duration }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                                <v-list-tile>
                                    <v-list-tile-avatar>
                                        <v-icon>mdi-calendar</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Date</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ race.race_date | moment("M/D/YYYY") }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex md6 s12>
                    <v-card>
                        <v-toolbar>
                            <v-toolbar-title>Series</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon color="primary">mdi-format-list-bulleted</v-icon>
                        </v-toolbar>
                        <v-card-text>
                            <v-list two-line>
                                <v-divider></v-divider>
                                <v-list-tile :to="'/series/'+race.series.id">
                                    <v-list-tile-avatar>
                                        <v-icon>mdi-information-variant</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Name</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ race.series.fullName }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                                <v-list-tile :to="'/races/series/'+race.series.id+'/season/'+race.season.id">
                                    <v-list-tile-avatar>
                                        <v-icon>mdi-calendar-clock</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Season</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ race.season.name }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                                <v-list-tile :href="race.series.website" target="_blank">
                                    <v-list-tile-avatar>
                                        <v-icon>web</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Website</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ race.series.website }}</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex xs12>
                    <v-card>
                        <v-toolbar>
                            <v-toolbar-title>Track</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon color="primary">mdi-road</v-icon>
                        </v-toolbar>
                        <v-card-text>
                            <v-layout row wrap>
                                <v-flex md6 xs12>
                                    <img :src="race.track.image" style="max-width:100%;">
                                </v-flex>
                                <v-flex md6 xs12>
                                    <v-list two-line>
                                        <v-divider></v-divider>
                                        <v-list-tile :to="'/tracks/'+race.track.id">
                                            <v-list-tile-avatar>
                                                <v-icon>mdi-information-variant</v-icon>
                                            </v-list-tile-avatar>
                                            <v-list-tile-content>
                                                <v-list-tile-title>Name</v-list-tile-title>
                                                <v-list-tile-sub-title>{{ race.track.name }}</v-list-tile-sub-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-divider></v-divider>
                                        <v-list-tile>
                                            <v-list-tile-avatar>
                                                <v-icon>mdi-ruler</v-icon>
                                            </v-list-tile-avatar>
                                            <v-list-tile-content>
                                                <v-list-tile-title>Length</v-list-tile-title>
                                                <v-list-tile-sub-title>{{ race.track.length }}mi / {{ (race.track.length * 1.60934).toFixed(2) }}km</v-list-tile-sub-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-divider></v-divider>
                                        <v-list-tile>
                                            <v-list-tile-avatar>
                                                <v-icon>mdi-undo-variant</v-icon>
                                            </v-list-tile-avatar>
                                            <v-list-tile-content>
                                                <v-list-tile-title>Corners</v-list-tile-title>
                                                <v-list-tile-sub-title>{{ race.track.numberOfCorners }}</v-list-tile-sub-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-divider></v-divider>
                                        <v-list-tile :href="race.track.website" target="_blank">
                                            <v-list-tile-avatar>
                                                <v-icon>web</v-icon>
                                            </v-list-tile-avatar>
                                            <v-list-tile-content>
                                                <v-list-tile-title>Website</v-list-tile-title>
                                                <v-list-tile-sub-title>{{ race.track.website }}</v-list-tile-sub-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-divider></v-divider>
                                    </v-list>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex xs12>
                    <v-card>
                        <v-toolbar>
                            <v-toolbar-title>Schedule</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon color="primary">mdi-calendar-range</v-icon>
                        </v-toolbar>
                        <v-card-text>
                            <v-list two-line>
                                <template v-for="(seasonRace, index) in seasonRaces" @key="seasonRace.id">
                                    <v-divider></v-divider>
                                    <v-list-tile :to="'/races/'+seasonRace.id" @click="" :key="seasonRace.id" ripple>
                                        <v-list-tile-content>
                                            <v-list-tile-title>{{index+1}}. {{ seasonRace.name }}</v-list-tile-title>
                                            <v-list-tile-sub-title>{{ seasonRace.track.name }}</v-list-tile-sub-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
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
    import axios from 'axios';
    export default {
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
                axios.get('/api/race/' + this.$route.params.id)
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
                axios.get('/api/series/' + seriesID + '/season/' + seasonID)
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
