<template>
    <v-layout row wrap>
        <v-flex xs12 class="pa-2">
            <template v-if="!loading">
                <v-toolbar>
                    <v-toolbar-title>
                        Races/Series
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-icon color="primary">mdi-chart-arc</v-icon>
                </v-toolbar>
                <v-card dark tile flat>
                    <v-card-text>
                        <doughnut :chart-data="datacollection" :options="options"></doughnut>
                    </v-card-text>
                </v-card>
            </template>
        </v-flex>
    </v-layout>
</template>


<script>
    import doughnut from '../charts/doughnut';
    export default {
        components: {
            doughnut
        },
        data() {
            return {
                loading: false,
                datacollection: {
                    labels: [],
                    datasets: [
                        {
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
                            data: []
                        }
                    ]
                },
                options: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            fontColor: 'white',
                            defaultFontSize: 14,
                            defaultFontFamily: "'Roboto', 'sans-serif'"
                        }
                    }
                },
                //responsive: true,
                //maintainAspectRatio: false
            }
        },
        mounted() {
            this.chartData()
        },
        methods: {
            chartData: function () {
                this.loading = true;
                this.$api.get('/api/series-races-count')
                    .then((response) => {
                        this.datacollection.datasets[0].data = response.data.racesCount;
                        this.datacollection.labels = response.data.seriesNames;
                        this.loading = false;
                    })
                    .catch((e) => {
                        this.loading = false;
                        console.log(e);
                    });
            }
        }
    }
</script>