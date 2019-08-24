<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex lg6 offset-lg3 md8 offset-md2 xs12>
                <v-card>
                    <v-toolbar color="grey darken-4">
                        <v-toolbar-title>Oops!</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-icon color="primary">mdi-alert-outline</v-icon>
                    </v-toolbar>
                    <v-img
                            src="/img/home/404.jpg"
                            height="400px"
                    >
                    </v-img>
                    <v-card-text>
                        We can't seem to find the page you are looking for.
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>


