<template>
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12 sm6 md4 class="pa-2">
                <v-card dark tile flat>
                    <v-container fill-height class="pa-0 pink darken-1 ma-0">
                        <v-layout row wrap align-center>
                            <v-flex lg3 xl2 md2 sm2 xs2>
                                <v-card-text>
                                    <v-icon large>mdi-flag-checkered</v-icon>
                                </v-card-text>
                            </v-flex>
                            <v-flex lg9 xl10 md10 sm10 xs10 class="pink lighten-1">
                                <v-card-text>
                                    <div class="subheading">
                                        <b>Races</b>
                                    </div>
                                    <div class="display-1">
                                        {{races.length}}
                                    </div>
                                </v-card-text>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card>
            </v-flex>

            <v-flex xs12 sm6 md4 class="pa-2">
                <v-card dark tile flat>
                    <v-container fill-height class="pa-0 light-blue darken-1 ma-0">
                        <v-layout row wrap align-center>
                            <v-flex lg3 xl2 md2 sm2 xs2>
                                <v-card-text>
                                    <v-icon large>mdi-format-list-bulleted</v-icon>
                                </v-card-text>
                            </v-flex>
                            <v-flex lg9 xl10 md10 sm10 xs10 class="light-blue lighten-1">
                                <v-card-text>
                                    <div class="subheading">
                                        <b>Series</b>
                                    </div>
                                    <div class="display-1">
                                        {{series.length}}
                                    </div>
                                </v-card-text>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card>
            </v-flex>

            <v-flex xs12 sm6 md4 class="pa-2">
                <v-card dark tile flat>
                    <v-container fill-height class="pa-0 teal darken-1 ma-0">
                        <v-layout row wrap align-center>
                            <v-flex lg3 xl2 md2 sm2 xs2>
                                <v-card-text>
                                    <v-icon large>mdi-road</v-icon>
                                </v-card-text>
                            </v-flex>
                            <v-flex lg9 xl10 md10 sm10 xs10 class="teal lighten-1">
                                <v-card-text>
                                    <div class="subheading">
                                        <b>Tracks</b>
                                    </div>
                                    <div class="display-1">
                                        {{tracks.length}}
                                    </div>
                                </v-card-text>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs12 sm6>
                <doughnutCard></doughnutCard>
            </v-flex>
            <v-flex xs12 sm6>
                <barCard></barCard>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import doughnutCard from './doughnutDash';
    import barCard from './barDash';
    export default {
        components: {
            doughnutCard,
            barCard
        },
        data() {
            return {
                races: [],
                tracks: [],
                series: []
            }
        },
        mounted() {
            this.getRaces();
            this.getTracks();
            this.getSeries();
            this.$store.dispatch('setUser');
        },
        computed: {
            userName () {
                return this.$store.getters.userName;
            },
            userId () {
                return this.$store.getters.userId;
            }
        },
        methods: {
            getRaces: function () {
                this.$api.get('/api/races')
                    .then((response) => {
                        this.races = response.data;
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            },
            getTracks: function () {
                this.$api.get('/api/tracks')
                    .then((response) => {
                        this.tracks = response.data;
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            },
            getSeries: function () {
                this.$api.get('/api/series')
                    .then((response) => {
                        this.series = response.data;
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            },
            logout: function () {
                this.$router.push('/logout');
            }
        }
    }
</script>