<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex lg8 offset-lg2 md8 offset-md2 xs12>
                <v-card>
                    <v-toolbar>
                        <v-toolbar-title>
                            About
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-icon color="primary">mdi-information-outline</v-icon>
                    </v-toolbar>
                    <v-list three-line>
                        <v-list-tile avatar>
                            <v-list-tile-avatar>
                                <v-icon>mdi-lightbulb-on</v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>The Idea</v-list-tile-title>
                                <v-list-tile-sub-title>Make a website that organizes racing videos from various racing series around the world.</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                    <v-list>
                        <v-divider></v-divider>
                        <v-subheader>Shout-out</v-subheader>
                        <v-list-tile avatar href="http://racingcircuits.info/" target="_blank">
                            <v-list-tile-avatar>
                                <v-icon>mdi-file-image</v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>Racingcircuits.info</v-list-tile-title>
                                <v-list-tile-sub-title>Provided the track layout images.</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile avatar href="http://bradboothmedia.com/" target="_blank">
                            <v-list-tile-avatar>
                                <v-icon>mdi-camera</v-icon>
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title>Brad Booth Media</v-list-tile-title>
                                <v-list-tile-sub-title>Designed the logo.</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
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
                            <v-list-tile-avatar tile>
                                <img src="https://cdn.vuetifyjs.com/images/logos/v-alt.svg">
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
                        <v-divider></v-divider>
                        <v-subheader>Copyright</v-subheader>
                        <p class="px-3">Racing Vods © {{ new Date().getFullYear() }}. All rights reserved. No copyright infringement intended.</p>
                    </v-list>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>