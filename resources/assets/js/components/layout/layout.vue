<template>
    <v-app id="inspire" :dark="theme">
        <v-navigation-drawer
                fixed
                v-model="drawer"
                app
        >
            <img src="/img/logo/racingVods-light.png" style="max-width: 100%;">
            <v-divider></v-divider>
            <v-list>
                <v-list-tile ripple @click="" to="/">
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
                <v-list-group
                        prepend-icon="mdi-account-multiple"
                        no-action
                >
                    <v-list-tile ripple slot="activator">
                        <v-list-tile-content>
                            <v-list-tile-title>Community</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile ripple @click="" href="https://discord.gg/VT3EpCd" target="_blank">
                        <v-list-tile-content>
                            <v-list-tile-title>Discord</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <!-- TODO: Add donation link -->
                    <v-list-tile ripple @click="" to="">
                        <v-list-tile-content>
                            <v-list-tile-title>Donation</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <v-list-tile ripple @click="" to="/about">
                    <v-list-tile-action>
                        <v-icon>mdi-information-outline</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>About</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar fixed app :color="theme ? '' : 'primary'">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title class="hidden-lg-and-up">
                Racing Vods
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon to="/races">
                <v-icon>mdi-flag-checkered</v-icon>
            </v-btn>
            <v-btn icon href="https://discord.gg/VT3EpCd" target="_blank">
                <v-icon>mdi-discord</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon>mdi-wallet-giftcard</v-icon>
            </v-btn>
            <!--<v-switch
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
        <v-footer class="pa-4">
            <v-spacer></v-spacer>
            <span>&copy; {{ new Date().getFullYear() }} Racing Vods</span>
        </v-footer>
    </v-app>
</template>

<script>
    export default {
        data () {
            return {
                theme: true,
                drawer: null
            }
        }
    }
</script>