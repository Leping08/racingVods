<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex md10 offset-md1 xs12>
                <template v-if="loadingRaces" >
                    <v-progress-circular indeterminate v-bind:size="70" v-bind:width="7" color="primary"></v-progress-circular>
                </template>
                <template v-if="!loadingRaces">
                    <v-toolbar>
                        <v-toolbar-title>
                            Schedule
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-icon color="primary">mdi-calendar-range</v-icon>
                    </v-toolbar>
                    <v-card>
                        <v-calendar
                                mode='single'
                                :theme-styles='themeStyles'
                                :is-expanded='true'
                                :attributes='attributes'
                                is-inline
                        >
                            <div
                                    slot='popover-header'
                                    slot-scope='{ dayInfo }'
                                    class='popover-header'>
                                {{ getPopoverHeaderLabel(dayInfo) }}
                            </div>
                        </v-calendar>
                    </v-card>
                </template>
            </v-flex>
        </v-layout>
    </v-container>
</template>


<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                races: {},
                attributes: null,
                loadingRaces: true,
                selectedDate: null,
                themeStyles: {
                    wrapper: {
                        color: '#fafafa',
                        border: '0',
                        padding: '10px',
                        background: 'color: #424242;'
                    },
                    header: {
                        padding: '15px 10px 25px 10px',
                    },
                    headerTitle: {
                        fontSize: '1.4rem',
                        fontWeight: '300',
                    },
                    headerArrows: {
                        fontSize: '2rem',
                        fontWeight: '100',
                    },
                    headerHorizontalDivider: {
                        borderTop: 'solid rgba(255, 255, 255, 0.2) 1px',
                        width: '80%',
                    },
                    weekdays: {
                        color: '#00c4a9',
                        fontWeight: '600',
                        padding: '20px 5px 10px 5px',
                    }
                }
            };
        },
        mounted() {
            this.getRaces();
        },
        methods: {
            getRaces: function () {
                axios.get('/api/races')
                    .then((response) => {
                        this.races = response.data;
                        this.getAttributes();
                    })
                    .catch((e) => {
                        this.loadingRaces = false;
                        console.log(e);
                    });
            },
            getAttributes: function () {
                this.attributes = [
                    // Today attribute
                    {
                        contentStyle: {
                            fontWeight: '700',
                            fontSize: '1rem',
                        },
                        dates: new Date()
                    },
                    // Attributes for races
                    ...this.races.map(({race_date, name, series}) => ({
                        dates: new Date(race_date),
                        highlight: {
                            backgroundColor: '#00c4a9',
                        },
                        popover: {
                            label: series.fullName+': '+name
                        }
                    }))
                ];
                this.loadingRaces = false;
            },
            getPopoverHeaderLabel(dayInfo) {
                const options = {weekday: 'short', year: 'numeric', month: 'short', day: 'numeric'};
                return dayInfo.date.toLocaleDateString(window.navigator.userLanguage || window.navigator.language, options);
            }
        }
    };
</script>


<style lang='sass' scoped>
    //TODO: Remove this css
    .popover-header
        text-align: center
        padding-bottom: 3px
        border-bottom: 1px solid #dadada
        margin: 0 0 3px 0
        opacity: 0.7
</style>