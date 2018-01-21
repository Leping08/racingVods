<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <template v-if="!loadingSeries">
                <v-flex xs12>
                    <v-toolbar>
                        <v-toolbar-title>Series</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-text-field
                                class="pr-3"
                                append-icon="search"
                                label="Search Series"
                                single-line
                                hide-details
                                v-model="search"
                        ></v-text-field>
                        <v-spacer></v-spacer>
                        <v-icon color="primary">mdi-format-list-bulleted</v-icon>
                    </v-toolbar>
                </v-flex>
                <template v-for="series in filteredSeries" @key="series.id">
                    <v-flex xl4 lg6 xs12>
                        <v-card ripple :hover="true" :to="/series/+series.id">
                            <v-card-media :src="'/img/series/'+series.image" height="300px">
                            </v-card-media>
                            <v-toolbar>
                                <v-toolbar-title>{{series.fullName}}</v-toolbar-title>
                                <v-spacer></v-spacer>
                                <v-btn outline round color="teal" :to="'/series/'+series.id">
                                    {{series.name}}
                                </v-btn>
                            </v-toolbar>
                        </v-card>
                    </v-flex>
                </template>
            </template>
            <template v-if="loadingSeries">
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
                series: [],
                loadingSeries: true,
                search: ''
            }
        },
        mounted() {
            this.getSeries();
        },
        methods: {
            getSeries: function () {
                axios.get('/api/series')
                    .then((response) => {
                        this.series = response.data;
                        this.loadingSeries = false;
                    })
                    .catch((e) => {
                        this.loadingSeries = false;
                        console.log(e);
                    });
            }
        },
        computed: {
            filteredSeries() {
                return this.series.filter(series => {
                    return ((series.fullName.toLowerCase().indexOf(this.search.toLowerCase()) > -1) || (series.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1))
                })
            }
        }
    }
</script>
