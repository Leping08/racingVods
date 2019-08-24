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
                <v-toolbar color="grey darken-4">
                    <v-toolbar-title>Races</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                            class="pr-3 pb-1"
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
                :items-per-page.sync="itemsPerPage"
                :footer-props="{ itemsPerPageOptions }"
                v-if="!loadingRaces"
        >
            <transition slot-scope="props"
                        appear
                        name="custom-classes-transition"
                        enter-active-class="animated fadeInUp"
                        leave-active-class="animated fadeOutDown">
                <v-row>
                    <v-col
                            v-for="race in props.items"
                            :key="race.id"
                            cols="12"
                            sm="12"
                            md="6"
                            lg="6"
                    >
                        <race-card :race="race" :title="race.season.name + ' ' + race.name"></race-card>
                    </v-col>
                </v-row>
            </transition>
        </v-data-iterator>
    </v-container>
</template>


<script>
    const RaceCard = () => import("../utilitys/race-card");
    export default {
        components: {RaceCard},
        data() {
            return {
                races: [],
                search: '',
                loadingRaces: true,
                itemsPerPageOptions: [12, 24, 48, { text: "All", value: -1 }],
                itemsPerPage: 12,
            }
        },
        mounted() {
            this.getRaces();
        },
        methods: {
            getRaces: function () {
                this.$axios.get('/api/races')
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
