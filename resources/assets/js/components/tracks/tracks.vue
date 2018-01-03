<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs12>
            <v-card>
                <v-toolbar>
                    <v-toolbar-title>Tracks</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                            class="pr-3"
                            append-icon="search"
                            label="Search"
                            single-line
                            hide-details
                            v-model="search"
                    ></v-text-field>
                    <v-spacer class="hidden-md-and-down"></v-spacer>
                    <v-btn icon @click="getRaces()">
                        <v-icon color="primary">refresh</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-data-table
                        v-bind:headers="headers"
                        v-bind:items="tracks"
                        v-bind:search="search"
                        :loading="loading"
                        v-bind:pagination.sync="pagination"
                        v-bind:rows-per-page-items="rowsPerPageItems"
                >
                    <router-link tag="tr" slot="items" slot-scope="props" :to="'/tracks/'+props.item.id">
                        <td class="text-xs-left">{{ props.item.name }}</td>
                        <td class="text-xs-right">{{ props.item.length }}</td>
                        <td class="text-xs-right">{{ (props.item.length * 1.60934).toFixed(2) }}</td>
                        <td class="text-xs-right">{{ props.item.numberOfCorners }}</td>
                    </router-link>
                </v-data-table>
            </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>


<script>
    import axios from 'axios';
    export default {
        data () {
            return {
                tracks: [],
                loadingTracks: true,
                search: '',
                loading: true,
                pagination: { sortBy: 'name' },
                rowsPerPageItems: [ 15, 30, 50, { text: "All", value: -1 }],
                headers: [
                    { text: 'Name', value: 'name',  align: 'left' },
                    { text: 'Length (mi)', value: 'length' },
                    { text: 'Length (km)', value: 'length' },
                    { text: 'Corners', value: 'numberOfCorners' }
                ]
            }
        },
        mounted() {
            this.getRaces();
        },
        methods: {
            getRaces: function () {
                this.loading = true;
                this.tracks = [];
                axios.get('/api/tracks')
                    .then((response) => {
                        this.tracks = response.data;
                        this.loading = false;
                    })
                    .catch((e) => {
                        this.loading = false;
                        console.log(e);
                    });
            }
        }
    }
</script>
