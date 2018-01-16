<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs12>
                <v-parallax jumbotron src="/img/home/home-heading.jpg" height="300">
                    <v-layout column align-center justify-center color="white">
                        <!--<h1 class="white--text display-1">Racing Vods</h1>
                        <h3 class="white--text">It's Kinda Like Netflix For Gearheads.</h3>-->
                        <img src="/img/logo/racingVods-light.png" style="max-width: 100%;" class="hidden-md-and-up">
                        <img src="/img/logo/racingVods-light.png" style="max-width: 50%;" class="hidden-sm-and-down">
                    </v-layout>
                </v-parallax>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex md4 xs12 d-flex>
                <v-card ripple class="text-xs-center" hover flat to="/series">
                    <v-card-text></v-card-text>
                    <v-card-text>
                        <v-icon x-large dark color="primary">mdi-format-list-bulleted</v-icon>
                    </v-card-text>
                    <v-card-text>
                        <h1 class="headline">Series</h1>
                    </v-card-text>
                    <v-card-text>
                        <p>Videos from the top racing series around the world including The FIA World Endurance Championship, Indy Car, and the International Motor Sports Association.</p>
                    </v-card-text>
                </v-card>
            </v-flex>

            <v-flex md4 xs12 d-flex>
                <v-card ripple class="text-xs-center" hover flat to="/races">
                    <v-card-text></v-card-text>
                    <v-card-text>
                        <v-icon x-large dark color="primary">mdi-flag-checkered</v-icon>
                    </v-card-text>
                    <v-card-text>
                        <h1 class="headline">Races</h1>
                    </v-card-text>
                    <v-card-text>
                        <p>Full race videos with the ability to jump to the start of the race and pick up watching where you left off.</p>
                    </v-card-text>
                </v-card>
            </v-flex>

            <v-flex md4 xs12 d-flex>
                <v-card ripple class="text-xs-center" hover flat to="/tracks">
                    <v-card-text></v-card-text>
                    <v-card-text>
                        <v-icon x-large dark color="primary">mdi-road</v-icon>
                    </v-card-text>
                    <v-card-text>
                        <h1 class="headline">Tracks</h1>
                    </v-card-text>
                    <v-card-text>
                        <p>Tracks from around the world with info including layouts, lap distances, corner names, and website.</p>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex md6 xs12>
                <v-card class="text-xs-center" flat>
                    <v-toolbar>
                        <v-toolbar-title>Racing Vods</v-toolbar-title>
                    </v-toolbar>
                </v-card>
                <v-parallax src="/img/home/nurbur-night.png" height="400">
                    <v-layout column align-right justify-center class="text-xs-right">
                        <h2 class="white--text">Built For Enthusiasts,<br>By Enthusiasts</h2>
                    </v-layout>
                </v-parallax>
            </v-flex>

            <v-flex md6 xs12>
                <v-card class="text-xs-center" flat>
                    <v-carousel v-if="!loadingRaces">
                        <template v-for="race in races" @key="race.id">
                            <v-carousel-item :src="'https://img.youtube.com/vi/'+race.youtube_id+'/hqdefault.jpg'" :to="'/races/'+race.id" style="text-decoration: none !important;">
                                <v-toolbar>
                                    <v-toolbar-title>{{race.name}}</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-btn outline round color="teal" :href="'/series/'+race.series.id">
                                        {{race.series.name}}
                                    </v-btn>
                                </v-toolbar>
                            </v-carousel-item>
                        </template>
                    </v-carousel>
                </v-card>
                <template v-if="loadingRaces">
                    <v-progress-circular indeterminate v-bind:size="70" v-bind:width="7" color="primary"></v-progress-circular>
                </template>
            </v-flex>
        </v-layout>
    </v-container>
</template>


<script>
    import axios from 'axios';
    export default {
        data () {
            return {
                races: [],
                loadingRaces: true
            }
        },
        mounted() {
            this.getRaces();
        },
        methods: {
            getRaces: function () {
                axios.get('/api/races/latest')
                    .then((response) => {
                        this.races = response.data;
                        this.loadingRaces = false;
                    })
                    .catch((e) => {
                        this.loadingRaces = false;
                        console.log(e);
                    });
            }
        }
    }
</script>
