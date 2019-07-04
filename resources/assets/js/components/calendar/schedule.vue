<template>
    <v-container fluid grid-list-md>
        <v-layout wrap>
            <v-flex
                    sm4
                    xs12
                    class="text-sm-left text-xs-center"
            >
                <v-btn @click="$refs.calendar.prev()">
                    <v-icon
                            dark
                            left
                    >
                        keyboard_arrow_left
                    </v-icon>
                    Prev
                </v-btn>
            </v-flex>
            <v-flex
                    sm4
                    class="text-xs-center"
            >
                <v-toolbar-title>{{start | month}} {{start | year}}</v-toolbar-title>
            </v-flex>
            <v-flex
                    sm4
                    xs12
                    class="text-sm-right text-xs-center"
            >
                <v-btn @click="$refs.calendar.next()">
                    Next
                    <v-icon
                            right
                            dark
                    >
                        keyboard_arrow_right
                    </v-icon>
                </v-btn>
            </v-flex>

            <v-flex
                    xs12
                    class="mb-3"
            >
                <v-sheet height="500">
                    <v-calendar
                            ref="calendar"
                            v-model="start"
                            :type="type"
                            color="primary"
                    >
                        <template
                                slot="day"
                                slot-scope="{ date }"
                        >
                            <template v-for="event in eventsMap[date]">
                                <v-menu
                                        :key="event.id"
                                        v-model="event.open"
                                        full-width
                                        offset-x
                                >
                                    <div
                                            slot="activator"
                                            v-ripple
                                            class="my-event"
                                            v-html="event.name"
                                    >Testing</div>
                                    <v-card
                                            min-width="300px"
                                            flat
                                            dark
                                    >
                                        <v-toolbar
                                                dark
                                        >
                                            <v-toolbar-title v-html="event.name"></v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            <v-btn round outline color="primary">{{event.series.name}}</v-btn>
                                        </v-toolbar>
                                        <v-card-text>
                                            <v-list two-line>
                                                <v-divider></v-divider>
                                                <v-list-tile :to="'/series/'+event.series.id">
                                                    <v-list-tile-avatar>
                                                        <v-icon>mdi-format-list-bulleted</v-icon>
                                                    </v-list-tile-avatar>
                                                    <v-list-tile-content>
                                                        <v-list-tile-title>Series</v-list-tile-title>
                                                        <v-list-tile-sub-title>{{ event.series.fullName }}</v-list-tile-sub-title>
                                                    </v-list-tile-content>
                                                </v-list-tile>
                                                <v-divider></v-divider>
                                                <v-list-tile :to="'/tracks/'+event.track.id">
                                                    <v-list-tile-avatar>
                                                        <v-icon>mdi-road</v-icon>
                                                    </v-list-tile-avatar>
                                                    <v-list-tile-content>
                                                        <v-list-tile-title>Track</v-list-tile-title>
                                                        <v-list-tile-sub-title>{{ event.track.name }}</v-list-tile-sub-title>
                                                    </v-list-tile-content>
                                                </v-list-tile>
                                                <v-divider></v-divider>
                                            </v-list>
                                        </v-card-text>
                                        <v-card-actions>
                                            <v-btn
                                                    :to="'/races/'+event.id"
                                            >
                                                Watch
                                                <v-icon right dark>mdi-eye</v-icon>
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-menu>
                            </template>
                        </template>
                    </v-calendar>
                </v-sheet>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import axios from 'axios';
    import moment from 'moment';
    export default {
        data: () => ({
            type: 'month',
            start: '2019-01-01',
            events: [],
            loadingEvents: true,
            typeOptions: [
                { text: 'Day', value: 'day' },
                { text: '4 Day', value: '4day' },
                { text: 'Week', value: 'week' },
                { text: 'Month', value: 'month' }
            ]
        }),
        computed: {
            // convert the list of events into a map of lists keyed by date
            eventsMap () {
                const map = {};
                this.events.forEach(e => (map[e.race_date] = map[e.race_date] || []).push(e));
                return map;
            }
        },
        methods: {
            open (event) {
                alert(event.title)
            },
            getEvents: function () {
                axios.get('/api/events')
                    .then((response) => {
                        this.events = response.data;
                        this.loadingEvents = false;
                    })
                    .catch((e) => {
                        this.loadingEvents = false;
                        console.log(e);
                    });
            }
        },
        mounted() {
            this.start = moment().format('YYYY-MM-DD');
            this.getEvents();
        },
        filters: {
            year: function (value) {
                return moment(value).format('YYYY');
            },
            month: function (value) {
                return moment(value).format('MMMM');
            }
        }
    }
</script>