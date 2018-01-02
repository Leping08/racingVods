<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <template v-for="series in series" @key="series.id" v-if="!loadingSeries">
                <v-flex md4 xs12>
                    <v-card :hover="true" :to="/series/+series.id">
                        <v-card-media :src="series.image" height="300px">
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
                loadingSeries: true
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
        }
    }
</script>
