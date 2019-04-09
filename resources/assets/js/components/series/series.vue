<template>
    <v-container fluid grid-list-md>
        <template v-if="loadingSeries">
            <v-progress-linear :indeterminate="true"></v-progress-linear>
        </template>
        <transition appear
                    name="custom-classes-transition"
                    enter-active-class="animated fadeInUp"
                    leave-active-class="animated fadeOutDown">
            <v-flex xs12 v-if="!loadingSeries">
                <v-toolbar>
                    <v-toolbar-title>Series</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                            class="pr-3 pb-3"
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
        </transition>


        <v-data-iterator
                :items="filteredSeries"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
                content-tag="v-layout"
                class="pt-2"
                row
                wrap
                v-if="!loadingSeries"
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
                    <v-card ripple :hover="true" :to="/series/+props.item.id">
                        <v-img
                                :src="'/img/series/'+props.item.image"
                                aspect-ratio="2"

                        ></v-img>
                        <v-toolbar>
                            <v-toolbar-title>{{props.item.fullName}}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn outline round color="teal" :to="'/series/'+props.item.id">
                                {{props.item.name}}
                            </v-btn>
                        </v-toolbar>
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
                series: [],
                loadingSeries: true,
                search: '',
                pagination: {
                    rowsPerPage: 12
                },
                rowsPerPageItems: [ 12, 24, 48, { text: "All", value: -1 }]
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
