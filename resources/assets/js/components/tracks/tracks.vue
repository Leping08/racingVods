<template>
    <v-container fluid grid-list-md>
        <template v-if="loadingTracks">
            <v-progress-linear :indeterminate="true"></v-progress-linear>
        </template>
        <transition appear
                    name="custom-classes-transition"
                    enter-active-class="animated fadeInUp"
                    leave-active-class="animated fadeOutDown">
            <v-flex xs12 v-if="!loadingTracks">
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
        </transition>

        <v-data-iterator
                :items="filteredTracks"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
                content-tag="v-layout"
                class="pt-2"
                row
                wrap
                v-if="!loadingTracks"
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
            </transition>
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
                pagination: {
                    rowsPerPage: 12
                },
                rowsPerPageItems: [ 12, 24, 48, { text: "All", value: -1 }]
            }
        },
        mounted() {
            this.getTracks();
        },
        methods: {
            getTracks: function () {
                this.loading = true;
                this.tracks = [];
                axios.get('/api/tracks')
                    .then((response) => {
                        this.tracks = response.data;
                        this.loadingTracks = false;
                    })
                    .catch((e) => {
                        this.loadingTracks = false;
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
