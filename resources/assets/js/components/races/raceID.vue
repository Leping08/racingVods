<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <template v-if="!loadingRace">
                <v-flex xs12>
                    <v-toolbar>
                        <v-toolbar-title>{{race.name}}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn round outline color="primary" @click="jumpToVodStart()">Race Start</v-btn>
                    </v-toolbar>
                </v-flex>
                <v-flex md9 xs12>
                    <v-card>
                        <v-card-text>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe id="vod" :src="'https://www.youtube.com/embed/'+race.youtube_id+'?rel=0;showinfo=0;enablejsapi=1&origin=http://racingvods.com'" allowfullscreen></iframe>
                            </div>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex md3 xs12>
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
                                        <v-icon>mdi-ruler</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Distance</v-list-tile-title>
                                        <!-- TODO: Make race distance real data -->
                                        <v-list-tile-sub-title>Placeholder</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-divider></v-divider>
                                <v-list-tile>
                                    <v-list-tile-avatar>
                                        <v-icon>mdi-calendar-clock</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>Season</v-list-tile-title>
                                        <v-list-tile-sub-title>{{ race.season.name }}</v-list-tile-sub-title>
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
                    <v-card class="mt-2">
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
                                        <v-list-tile-sub-title>{{ race.series.name }}</v-list-tile-sub-title>
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
                                            <v-list-tile-sub-title>{{ race.track.length }}</v-list-tile-sub-title>
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
            </template>
            <template v-if="loadingRace">
                <v-progress-circular indeterminate v-bind:size="70" v-bind:width="7" color="primary"></v-progress-circular>
            </template>
        </v-layout>
    </v-container>
</template>


<script>
    import axios from 'axios';
    export default {
        data () {
            return {
                race: [],
                loadingRace: true,
                player: {}
            }
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
                    })
                    .catch((e) => {
                        this.loadingRace = false;
                        console.log(e);
                    });
            },
            jumpToVodStart: function () {
                window.vodTime = this.race.youtube_start_time;
                if(window.player){
                    setTimeout(function(){
                        window.player.seekTo(Number(window.vodTime));
                        window.player.playVideo();
                    }, 1000);
                }else{
                    window.player = new YT.Player('vod');
                    setTimeout(function(){
                        window.player.seekTo(Number(window.vodTime));
                        window.player.playVideo();
                    }, 1000);
                }
            }
        }
    }
</script>
