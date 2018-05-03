<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <template v-if="!loadingSeries">
                <v-flex lg6 offset-lg3 md8 offset-md2 xs12>
                    <v-toolbar>
                        <v-toolbar-title>{{series.fullName}}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn outline round color="teal" :to="'/series/'+series.id">
                            {{series.name}}
                        </v-btn>
                    </v-toolbar>
                    <v-card>
                        <img :src="'/img/series/'+series.image" style="max-width: 100%">
                        <v-card-text>
                            <v-list>
                                <v-subheader>Seasons</v-subheader>
                                <template v-for="season in seasons" @key="season.id">
                                    <v-list-tile @click="" :to="'/races/series/'+series.id+'/season/'+season.id">
                                        <v-list-tile-content>
                                            <v-list-tile-title>{{ season.name }}</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </template>
                                <v-divider></v-divider>
                                <v-subheader>Description</v-subheader>
                                <p class="px-3">{{series.description}}</p>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-flex>
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
        data() {
            return {
                series: [],
                seasons: [],
                loadingSeries: true,
            }
        },
        mounted() {
            this.getSeries();
        },
        methods: {
            getSeries: function () {
                axios.get('/api/series/' + this.$route.params.id)
                    .then((response) => {
                        this.series = response.data[0];
                        this.seasons = response.data['seasons'];
                        this.loadingSeries = false;
                    })
                    .catch((e) => {
                        this.loadingSeries = false;
                        console.log(e);
                    });
            }
        }
    }
</script>