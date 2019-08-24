<template>
    <v-layout row wrap>
        <v-flex xs12 class="pa-2">
            <template v-if="!loading">
                <v-app-bar>
                    <v-toolbar-title>
                        Races/Season
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-icon color="primary">mdi-chart-bar</v-icon>
                </v-app-bar>
                <v-card tile flat>
                    <v-card-text>
                        <bar :chart-data="datacollection" :options="options"></bar>
                    </v-card-text>
                </v-card>
            </template>
        </v-flex>
    </v-layout>
</template>


<script>
    import bar from '../charts/bar';
    export default {
        components: {
            bar
        },
        data() {
            return {
                loading: false,
                datacollection: {
                    labels: [],
                    datasets: [
                        {
                            label: "Races",
                            backgroundColor: [
                                '#4DB6AC',
                                '#4FC3F7',
                                '#F06292',
                                '#7986CB',
                                '#FFF176',
                                '#FFB74D',
                                '#A1887F',
                                '#90A4AE'
                            ],
                            borderColor: 'white',
                            borderWidth: 1,
                            data: []
                        }
                    ]
                },
                options: {
                    legend: {
                        display: false,
                        labels: {
                            // This more specific font property overrides the global property
                            fontColor: 'white',
                            defaultFontSize: 14,
                            defaultFontFamily: "'Roboto', 'sans-serif'"
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                fontColor: "white"
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: "white"
                            }
                        }]
                    },
                    //responsive: true,
                    //maintainAspectRatio: false
                }
            }
        },
        mounted() {
            this.chartData()
        },
        methods: {
            chartData: function () {
                this.loading = true;
                this.$api.get('/api/season-races-count')
                    .then((response) => {
                        this.datacollection.datasets[0].data = response.data.racesCount;
                        this.datacollection.labels = response.data.seasonNames;
                        this.loading = false;
                    })
                    .catch((e) => {
                        console.log(e);
                        this.loading = false;
                    });
            }
        }
    }
</script>