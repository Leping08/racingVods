<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex lg6 offset-lg3 md8 offset-md2 xs12>
                <v-card>
                    <v-toolbar>
                        <v-toolbar-title>
                            About
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-icon color="primary">mdi-information-outline</v-icon>
                    </v-toolbar>
                    <!-- TODO: Add copyright disclaimer -->
                    <v-list>
                        <v-subheader>The Idea</v-subheader>
                        <p class="px-3">Assemble and categorize racing videos from various racing series around the world.</p>
                        <v-divider></v-divider>
                        <v-subheader>Tech Stack</v-subheader>
                        <v-list-tile avatar href="https://vuejs.org/" target="_blank">
                            <v-list-tile-avatar>
                                <v-icon large>devicon-vuejs-plain colored</v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>Vuejs</v-list-tile-title>
                                <v-list-tile-sub-title>Front End</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile avatar href="https://vuetifyjs.com/" target="_blank">
                            <v-list-tile-avatar>
                                <img src="https://vuetifyjs.com/static/doc-images/logo.svg">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>Vuetify</v-list-tile-title>
                                <v-list-tile-sub-title>Application Theme</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile avatar href="https://laravel.com/" target="_blank">
                            <v-list-tile-avatar>
                                <v-icon large>devicon-laravel-plain colored</v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>Laravel</v-list-tile-title>
                                <v-list-tile-sub-title>Back End API</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>

                        <v-list-tile avatar href="https://aws.amazon.com/" target="_blank">
                            <v-list-tile-avatar>
                                <v-icon large>devicon-amazonwebservices-plain colored</v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>Amazon Web Services</v-list-tile-title>
                                <v-list-tile-sub-title>Linux Server</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>