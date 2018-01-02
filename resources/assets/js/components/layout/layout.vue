<template>
    <v-app id="inspire" :dark="theme">
        <v-navigation-drawer
                fixed
                v-model="drawer"
                app
        >
            <v-toolbar flat>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-title>
                            Racing Vods
                        </v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-toolbar>
            <v-divider></v-divider>
            <v-list>
                <v-list-tile @click="" to="/home">
                    <v-list-tile-action>
                        <v-icon>home</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Home</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="" to="/series">
                    <v-list-tile-action>
                        <v-icon>mdi-format-list-bulleted</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Series</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="" to="/races">
                    <v-list-tile-action>
                        <v-icon>mdi-flag-checkered</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Races</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="">
                    <v-list-tile-action>
                        <v-icon>mdi-road</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Tracks</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="" to="/schedule">
                    <v-list-tile-action>
                        <v-icon>mdi-calendar-range</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Schedule</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider></v-divider>
                <v-subheader>Additional resources</v-subheader>
                <v-list-tile @click="" to="/about">
                    <v-list-tile-action>
                        <v-icon>mdi-information-outline</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>About</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-group
                        prepend-icon="mdi-account-multiple"
                        no-action
                >
                    <v-list-tile slot="activator">
                        <v-list-tile-content>
                            <v-list-tile-title>Comunity</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile @click="" to="">
                        <v-list-tile-content>
                            <v-list-tile-title>Discord</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile @click="" to="">
                        <v-list-tile-content>
                            <v-list-tile-title>Patreon</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar fixed app :color="theme ? '' : 'primary'">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-switch label="Night Mode" v-model="theme" color="blue" class="pt-4" :color="theme ? 'primary' : ''"></v-switch>
        </v-toolbar>
        <v-content :dark="theme">
            <v-container fluid fill-height :class="theme ? 'grey darken-2' : 'grey lighten-2'">
                <router-view></router-view>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    export default {
        data: () => ({
            theme: true,
            drawer: null
        })
    }
</script>