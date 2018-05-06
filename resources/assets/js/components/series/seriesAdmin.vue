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

                    <v-data-table
                            :headers="headers"
                            :items="filteredSeries"
                            class="elevation-1"
                    >
                        <transition slot="items" slot-scope="props"
                                    appear
                                    name="custom-classes-transition"
                                    enter-active-class="animated bounceInUp"
                                    leave-active-class="animated bounceOutDown"
                        >
                            <router-link tag="tr" :to="'/series/edit/'+props.item.id">
                                <td>{{ props.item.id }}</td>
                                <td>{{ props.item.fullName }}</td>
                                <td>{{ props.item.name }}</td>
                            </router-link>
                        </transition>
                    </v-data-table>
                </v-flex>
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
                search: '',
                headers: [
                    { text: 'Id', value: 'id' },
                    { text: 'Name', value: 'fullName' },
                    { text: 'Shorthand', value: 'name' }
                ]
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
