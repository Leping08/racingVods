<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <template v-if="!loadingSeries">
                <v-flex lg6 offset-lg3 md8 offset-md2 xs12>
                    <v-toolbar color="grey darken-4">
                        <v-toolbar-title>{{series.full_name}}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn outlined rounded color="primary" :to="'/series/'+series.id">
                            {{series.name}}
                        </v-btn>
                    </v-toolbar>
                    <v-card>
                        <v-img alt="" :src="'/img/series/'+series.image" style="max-width: 100%"></v-img>
                        <v-card-text>
                            <v-list shaped>
                                <v-subheader class="title">Seasons</v-subheader>
                                <template v-for="(season, index) in series.seasons" @key="season.id">
                                    <v-divider></v-divider>
                                    <v-list-item
                                            :key="index"
                                            ripple
                                            :to="'/races/series/'+series.id+'/season/'+season.id"
                                    >
                                        <v-list-item-content>
                                            <v-list-item-title>{{ season.name }}</v-list-item-title>
                                        </v-list-item-content>
                                    </v-list-item>
                                </template>
                                <v-divider></v-divider>
                                <v-subheader class="title">Description</v-subheader>
                                <p class="px-3">{{series.description}}</p>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </template>
            <template v-if="loadingSeries">
                <v-progress-circular indeterminate v-bind:size="70" v-bind:width="7"
                                     color="primary"></v-progress-circular>
            </template>
        </v-layout>
    </v-container>
</template>


<script>
    export default {
        data() {
            return {
                series: [],
                loadingSeries: true,
            }
        },
        mounted() {
            this.getSeries();
        },
        methods: {
            getSeries: function () {
                this.$axios.get('/api/series/' + this.$route.params.id)
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