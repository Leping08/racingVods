<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <template v-if="!loadingRaces">
                <v-flex xs12>
                    <v-toolbar color="grey darken-4 mx-2">
                        <v-toolbar-title>{{races[0].season.name}} {{races[0].series.full_name}}</v-toolbar-title>
                    </v-toolbar>
                </v-flex>
                <template v-for="race, index in races" @key="race.id">
                    <v-flex lg6 xs12>
                        <race-card class="ma-2" :race="race" :title="(index+1) + '. ' + race.name"></race-card>
                    </v-flex>
                </template>
            </template>
            <template v-if="loadingRaces">
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
                races: [],
                loadingRaces: true
            }
        },
        mounted() {
            this.getSeries();
        },
        methods: {
            getSeries: function () {
                this.$axios.get('/api/series/' + this.$route.params.seriesID + '/season/' + this.$route.params.seasonID)
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