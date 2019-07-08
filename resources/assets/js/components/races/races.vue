<template>
    <v-container fluid grid-list-md>
        <template v-if="loadingRaces">
            <v-progress-linear :indeterminate="true"></v-progress-linear>
        </template>
        <transition appear
                    name="custom-classes-transition"
                    enter-active-class="animated fadeInUp"
                    leave-active-class="animated fadeOutDown">
            <v-flex xs12 v-if="!loadingRaces">
                <v-toolbar>
                    <v-toolbar-title>Races</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                            class="pr-3 pb-3"
                            append-icon="search"
                            label="Search Races"
                            single-line
                            hide-details
                            v-model="search"
                    ></v-text-field>
                    <v-spacer></v-spacer>
                    <v-icon color="primary">mdi-flag-checkered</v-icon>
                    <!-- TODO: Add filter to races -->
                </v-toolbar>
            </v-flex>
        </transition>


        <v-data-iterator
                :items="filteredRaces"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
                content-tag="v-layout"
                class="pt-2"
                row
                wrap
                v-if="!loadingRaces"
        >
            <transition slot="item" slot-scope="props"
                        appear
                        name="custom-classes-transition"
                        enter-active-class="animated fadeInUp"
                        leave-active-class="animated fadeOutDown"
            >
                <v-flex
                        xs12
                        sm6
                        md6
                        lg6
                >
                    <race-card :race="props.item"></race-card>
                </v-flex>
            </transition>
        </v-data-iterator>
    </v-container>
</template>


<script>
    import axios from 'axios';
    import RaceCard from "../utilitys/race-card";
    export default {
        components: {RaceCard},
        data () {
            return {
                races: [],
                search: '',
                loadingRaces: true,
                pagination: {
                    rowsPerPage: 12
                },
                rowsPerPageItems: [ 12, 24, 48, { text: "All", value: -1 }]
            }
        },
        mounted() {
            this.getRaces();
        },
        methods: {
            getRaces: function () {
                axios.get('/api/races')
                    .then((response) => {
                        this.races = response.data;
                        this.loadingRaces = false;
                    })
                    .catch((e) => {
                        this.loadingRaces = false;
                        console.log(e);
                    });
            },
            hideBadThumbnails: function (event) {
                console.log(event);
            }
        },
        computed: {
            filteredRaces() {
                return this.races.filter(race => {
                    return ((race.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1) || (race.series.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1))
                })
            }
        }
    }
</script>
