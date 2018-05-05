<template>
    <v-container fluid grid-list-md>
        <v-flex xs12>
            <v-toolbar>
                <v-toolbar-title>Tracks</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-text-field
                        class="pr-3"
                        append-icon="search"
                        label="Search Tracks"
                        single-line
                        hide-details
                        v-model="search"
                ></v-text-field>
                <v-spacer></v-spacer>
                <v-icon color="primary">mdi-road</v-icon>
            </v-toolbar>
        </v-flex>

        <v-data-iterator
                :items="filteredTracks"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
                content-tag="v-layout"
                class="pt-2"
                row
                wrap
        >
            <v-flex
                    slot="item"
                    slot-scope="props"
                    xs12
                    sm6
                    md4
                    lg4
            >
                <v-card ripple :hover="true" :to="/tracks/+props.item.id">
                    <v-toolbar>
                        <v-toolbar-title>{{props.item.name}}</v-toolbar-title>
                    </v-toolbar>
                    <img :src="props.item.image" width="100%">
                </v-card>
            </v-flex>
        </v-data-iterator>
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
                pagination: {
                    rowsPerPage: 6
                },
                rowsPerPageItems: [ 6, 15, 30, { text: "All", value: -1 }],
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
        },
        computed: {
            filteredTracks() {
                return this.tracks.filter(tracks => {
                    return (tracks.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1)
                })
            }
        }
    }
</script>
