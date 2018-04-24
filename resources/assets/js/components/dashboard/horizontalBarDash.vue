<template>
    <v-layout row wrap>
        <v-flex xs12 class="pa-2">
            <template v-if="!loading">
                <v-toolbar>
                    <v-toolbar-title>
                        Races/Season
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-icon color="primary">mdi-chart-histogram</v-icon>
                </v-toolbar>
                <v-card dark tile flat>
                    <v-card-text>
                        <horizontalBar :chart-data="datacollection" :options="options"></horizontalBar>
                    </v-card-text>
                </v-card>
            </template>
        </v-flex>
    </v-layout>
</template>


<script>
    import horizontalBar from '../charts/horizontalBar';
    export default {
        components: {
            horizontalBar
        },
        data() {
            return {
                loading: false,
                datacollection: {
                    labels: [],
                    datasets: [
                        {
                            label: "Races",
                            //backgroundColor: '#00c4a9',
                            backgroundColor: ['#F06292', '#64B5F6'],
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
                    responsive: true,
                    maintainAspectRatio: false
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