<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs12 sm8 offset-sm2>
                <v-card>
                    <v-toolbar color="" dark>
                        <v-toolbar-title>Dashboard</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon>
                            <v-icon color="primary">mdi-lock</v-icon>
                        </v-btn>
                    </v-toolbar>
                    <v-card-text>
                        {{$store.state.authCheck}}
                        <v-btn color="red" @click="logout">Logout</v-btn>
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
                races: {}
            }
        },
        mounted() {
            this.getRaces();
        },
        methods: {
            getRaces: function () {
                this.$api.get('/api/races')
                    .then((response) => {
                        this.races = response.data;
                        this.loadingRaces = false;
                    })
                    .catch((e) => {
                        this.loadingRaces = false;
                        console.log(e);
                    });
            },
            logout: function () {
                this.$router.push('/logout');
            }
        }
    }
</script>