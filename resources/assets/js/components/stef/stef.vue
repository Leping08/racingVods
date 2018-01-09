<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex lg6 offset-lg3 md8 offset-md2 xs12>
                <v-card>
                    <v-toolbar>
                        <v-toolbar-title>
                            Stef SEO
                        </v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <p class="title">
                            Money made so far ${{ total.toFixed(2) }}
                        </p>
                        <v-btn outline round color="primary" @click="seoBool=true">Start SEO</v-btn>
                        <v-btn outline round color="red" @click="seoBool=false">Stop SEO</v-btn>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>


<script>
    export default {
        data() {
            return {
                hourRate: 16.00,
                total: 0,
                seoBool: false,
            }
        },
        mounted() {
            this.seo();
        },
        methods: {
            seo: function () {
                setInterval( () => {
                    if(this.seoBool){
                        this.total = ((this.hourRate / 60 / 60) + this.total);
                    }
                }, 1000);
            }
        }
    }
</script>

