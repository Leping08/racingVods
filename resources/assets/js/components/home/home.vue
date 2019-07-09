<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs12>
                <v-img :aspect-ratio="16/9" max-height="300px" src="/img/home/home-heading.jpg">
                    <v-layout align-center justify-center row fill-height>
                        <v-img src="/img/logo/racingVods-light.png" max-width="90%;" class="hidden-md-and-up"></v-img>
                        <v-img src="/img/logo/racingVods-light.png" max-width="45%" class="hidden-sm-and-down"></v-img>
                    </v-layout>
                </v-img>
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
                        <p>Videos from the top racing series around the world including the FIA World Endurance Championship, Indy Car, and the International Motor Sports Association.</p>
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
                <v-parallax src="/img/home/nurbur-night.jpg" height="435" class="elevation-2">
                    <v-layout column align-right justify-center class="text-xs-right">
                        <h2 class="white--text">Built For Enthusiasts,<br>By Enthusiasts</h2>
                    </v-layout>
                </v-parallax>
            </v-flex>

            <v-flex md6 xs12>
                <v-card class="text-xs-center" flat>
                    <v-carousel v-if="!loadingRaces" >
                        <template v-for="race in races" @key="race.id">
                            <router-link :to="'/races/'+race.id" style="text-decoration: none !important; background-size: auto;">
                                <v-carousel-item :src="race.videos[0].thumbnail">
                                    <race-toolbar :race="race"></race-toolbar>
                                </v-carousel-item>
                            </router-link>
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
    import RaceToolbar from "../utilitys/race-toolbar";
    export default {
        components: {RaceToolbar},
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
                this.$axios.get('/api/races/latest')
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
