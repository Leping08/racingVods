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
                <v-toolbar color="grey darken-4">
                    <v-toolbar-title>Series</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                            class="pr-3 pb-1"
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
                :items-per-page.sync="itemsPerPage"
                :footer-props="{ itemsPerPageOptions }"
                v-if="!loadingSeries"
        >
            <transition slot-scope="props"
                        appear
                        name="custom-classes-transition"
                        enter-active-class="animated fadeInUp"
                        leave-active-class="animated fadeOutDown">
                <v-row>
                    <v-col
                            v-for="series in props.items"
                            :key="series.id"
                            cols="12"
                            sm="12"
                            md="6"
                            lg="6"
                    >
                        <v-card ripple :hover="true" :to="/series/+series.id">
                            <v-toolbar color="grey darken-4">
                                <v-toolbar-title>{{series.full_name}}</v-toolbar-title>
                                <v-spacer></v-spacer>
                                <v-btn outlined rounded color="primary" :to="'/series/'+series.id">
                                    {{series.name}}
                                </v-btn>
                            </v-toolbar>
                            <v-img
                                    :src="'/img/series/'+series.image"
                                    aspect-ratio="2"
                            ></v-img>
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
                series: [],
                loadingSeries: true,
                search: '',
                itemsPerPageOptions: [12, 24, 48, { text: "All", value: -1 }],
                itemsPerPage: 12,
            }
        },
        mounted() {
            this.getSeries();
        },
        methods: {
            getSeries: function () {
                this.$axios.get('/api/series')
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
                    return ((series.full_name.toLowerCase().indexOf(this.search.toLowerCase()) > -1) || (series.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1))
                })
            }
        }
    }
</script>
