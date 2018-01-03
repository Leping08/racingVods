<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <template v-for="race, index in races" @key="race.id" v-if="!loadingRaces">
                <v-flex lg4 md6 xs12>
                    <v-card ripple :hover="true" :to="/races/+race.id">
                        <v-toolbar>
                            <v-toolbar-title>{{++index}}. {{race.name}}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn outline round color="teal" :to="'/series/'+race.series.id">
                                {{race.series.name}}
                            </v-btn>
                        </v-toolbar>
                        <v-card-media
                                :src="'https://img.youtube.com/vi/'+race.youtube_id+'/hqdefault.jpg'"
                                height="280px"
                        >
                        </v-card-media>
                    </v-card>
                </v-flex>
            </template>
            <template v-if="loadingRaces">
                <v-progress-circular indeterminate v-bind:size="70" v-bind:width="7" color="primary"></v-progress-circular>
            </template>
        </v-layout>
    </v-container>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                races: [],
                loadingRaces: true
            }
        },
        mounted() {
            this.getSeries();
        },
        methods: {
            getSeries: function () {
                axios.get('/api/series/' + this.$route.params.seriesID + '/season/' + this.$route.params.seasonID)
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