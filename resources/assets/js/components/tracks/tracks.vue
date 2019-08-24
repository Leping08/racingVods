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
                    <v-toolbar color="grey darken-4">
                        <v-toolbar-title>Tracks</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-text-field
                                class="pr-3 pb-1"
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
                :items-per-page.sync="itemsPerPage"
                :footer-props="{ itemsPerPageOptions }"
                v-if="!loadingTracks"
        >
            <transition slot-scope="props"
                        appear
                        name="custom-classes-transition"
                        enter-active-class="animated fadeInUp"
                        leave-active-class="animated fadeOutDown">
                <v-row>
                    <v-col
                            v-for="track in props.items"
                            :key="track.id"
                            cols="12"
                            sm="12"
                            md="6"
                            lg="6"
                    >
                        <v-card ripple :hover="true" :to="/tracks/+track.id">
                            <v-toolbar color="grey darken-4">
                                <v-toolbar-title>{{track.name}}</v-toolbar-title>
                            </v-toolbar>
                            <v-img alt="" :src="track.image" width="100%"></v-img>
                        </v-card>
                    </v-col>
                </v-row>
            </transition>
        </v-data-iterator>
    </v-container>
</template>


<script>
    export default {
        data () {
            return {
                tracks: [],
                loadingTracks: true,
                search: '',
                itemsPerPageOptions: [12, 24, 48, { text: "All", value: -1 }],
                itemsPerPage: 12,
            }
        },
        mounted() {
            this.getTracks();
        },
        methods: {
            getTracks: function () {
                this.loading = true;
                this.tracks = [];
                this.$axios.get('/api/tracks')
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
