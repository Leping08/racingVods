<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex lg8 offset-lg2 md8 offset-md2 xs12>
                <v-card>
                    <v-toolbar color="grey darken-4">
                        <v-toolbar-title>
                            About
                        </v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-icon color="primary">mdi-information-outline</v-icon>
                    </v-toolbar>

                    <v-list>
                        <v-list-item avatar>
                            <v-list-item-icon>
                                <v-icon>mdi-lightbulb-on</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>The Idea</v-list-item-title>
                                <v-list-item-subtitle>Make a website that organizes racing videos from various racing series around the world.</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-divider></v-divider>
                        <v-subheader>Tips and Tricks</v-subheader>
                        <v-list-item avatar>
                            <v-list-item-icon>
                                <v-icon>mdi-clock-start</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Race Start</v-list-item-title>
                                <v-list-item-subtitle>Sick of the pre race ceremonies? So are we. Use the race start button to jump to the drop of the green flag.</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item avatar href="https://chrome.google.com/webstore/detail/adblock-for-youtube/cmedhionkhpnakcndndgjdbohmhepckk" target="_blank">
                            <v-list-item-icon>
                                <v-icon>mdi-cancel</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Ad Block for Youtube</v-list-item-title>
                                <v-list-item-subtitle>No one likes ads, so use this chrome browser extension to get rid of them.</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-divider></v-divider>
                        <v-subheader>Shout Outs</v-subheader>
                        <v-list-item avatar href="http://racingcircuits.info/" target="_blank">
                            <v-list-item-icon>
                                <v-icon>mdi-file-image</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Racingcircuits.info</v-list-item-title>
                                <v-list-item-subtitle>Provided the track layout images.</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item avatar href="http://bradboothmedia.com/" target="_blank">
                            <v-list-item-icon>
                                <v-icon>mdi-camera</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Brad Booth Media</v-list-item-title>
                                <v-list-item-subtitle>Designed the logo.</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item avatar href="https://deltavcreative.com/" target="_blank">
                            <v-list-item-icon>
                                <v-icon>mdi-server-network</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>DeltaV Creative</v-list-item-title>
                                <v-list-item-subtitle>Built and maintains the website.</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-divider></v-divider>
                        <v-subheader>Tech Stack</v-subheader>
                        <v-list-item avatar href="https://vuejs.org/" target="_blank">
                            <v-list-item-icon>
                                <v-icon large>devicon-vuejs-plain colored</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Vuejs</v-list-item-title>
                                <v-list-item-subtitle>Front End</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item avatar href="https://vuetifyjs.com/" target="_blank">
                            <v-list-item-avatar tile>
                                <v-img src="https://cdn.vuetifyjs.com/images/logos/v-alt.svg"></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title>Vuetify</v-list-item-title>
                                <v-list-item-subtitle>Application Theme</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item avatar href="https://laravel.com/" target="_blank">
                            <v-list-item-icon>
                                <v-icon large>devicon-laravel-plain colored</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Laravel</v-list-item-title>
                                <v-list-item-subtitle>Back End API</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item avatar href="https://aws.amazon.com/" target="_blank">
                            <v-list-item-icon>
                                <v-icon large>devicon-amazonwebservices-plain colored</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Amazon Web Services</v-list-item-title>
                                <v-list-item-subtitle>Linux Server</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                        <v-divider></v-divider>
                        <v-subheader>Copyright</v-subheader>
                        <p class="px-3">Racing Vods © {{ new Date().getFullYear() }}. All rights reserved. No copyright infringement intended.</p>
                    </v-list>
                </v-card>
            </v-flex>
        </v-layout>
        <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">
    </v-container>
</template>