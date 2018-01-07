<template>
    <v-app id="inspire" :dark="theme">
        <v-navigation-drawer
                fixed
                v-model="drawer"
                app
        >
            <!--<v-toolbar>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-title>
                            Racing Vods
                    </v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-toolbar>
            <v-divider></v-divider>-->
            <v-list>
                <v-list-tile ripple @click="" to="/home">
                    <v-list-tile-action>
                        <v-icon>home</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Home</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple @click="" to="/series">
                    <v-list-tile-action>
                        <v-icon>mdi-format-list-bulleted</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Series</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple @click="" to="/races">
                    <v-list-tile-action>
                        <v-icon>mdi-flag-checkered</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Races</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple @click="" to="/tracks">
                    <v-list-tile-action>
                        <v-icon>mdi-road</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Tracks</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple @click="" to="/schedule">
                    <v-list-tile-action>
                        <v-icon>mdi-calendar-range</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Schedule</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider></v-divider>
                <v-subheader>Additional resources</v-subheader>
                <v-list-tile ripple @click="" to="/about">
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
                    <v-list-tile ripple slot="activator">
                        <v-list-tile-content>
                            <v-list-tile-title>Community</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <!-- TODO: Add discord link -->
                    <v-list-tile ripple @click="" to="">
                        <v-list-tile-content>
                            <v-list-tile-title>Discord</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <!-- TODO: Add patreon link -->
                    <v-list-tile ripple @click="" to="">
                        <v-list-tile-content>
                            <v-list-tile-title>Patreon</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <!-- <v-divider></v-divider>
                <v-subheader>Admin</v-subheader>
                <v-list-tile ripple @click="" to="/add/race">
                    <v-list-tile-action>
                        <v-icon>mdi-plus-circle-outline</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Races</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile ripple @click="" to="/add/track">
                    <v-list-tile-action>
                        <v-icon>mdi-plus-circle-outline</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Tracks</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile> -->
            </v-list>
        </v-navigation-drawer>
        <v-toolbar fixed app :color="theme ? '' : 'primary'">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Racing Vods</v-toolbar-title>
            <!--<v-spacer></v-spacer>
            <v-switch
                    label="Night Mode"
                    v-model="theme"
                    class="pt-4 text-xs-right"
                    :color="theme ? 'primary' : ''"
                    ripple
            ></v-switch>-->
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
            drawer: false
        })
    }
</script>