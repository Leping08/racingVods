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
                        <v-icon>mdi-home</v-icon>
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
                    <!--<v-list-tile ripple @click="" to="">-->
                    <!--<v-list-tile-content>-->
                    <!--<v-list-tile-title>Donation</v-list-tile-title>-->
                    <!--</v-list-tile-content>-->
                    <!--</v-list-tile>-->
                </v-list-group>
                <v-list-tile ripple @click="" to="/about">
                    <v-list-tile-action>
                        <v-icon>mdi-information-outline</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>About</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <template v-if="authCheck">
                    <v-divider></v-divider>
                    <v-subheader>Admin</v-subheader>
                    <v-list-tile ripple @click="" to="/dashboard">
                        <v-list-tile-action>
                            <v-icon>mdi-account-key</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Dashboard</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-group
                            prepend-icon="mdi-settings"
                            no-action
                    >
                        <v-list-tile ripple slot="activator">
                            <v-list-tile-content>
                                <v-list-tile-title>Edit</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile ripple @click="" to="/add/series">
                            <v-list-tile-content>
                                <v-list-tile-title>Series</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile ripple @click="" to="/edit/races">
                            <v-list-tile-content>
                                <v-list-tile-title>Races</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile ripple @click="" to="/add/video">
                            <v-list-tile-content>
                                <v-list-tile-title>Videos</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile ripple @click="" to="/edit/tracks">
                            <v-list-tile-content>
                                <v-list-tile-title>Tracks</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list-group>
                </template>
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
        <v-content :class="theme ? 'grey darken-2' : 'grey lighten-2'">
            <router-view :key="$route.fullPath"></router-view>
        </v-content>
        <v-footer class="pa-4">
            <v-spacer></v-spacer>
            <span>&copy; {{ new Date().getFullYear() }} Racing Vods</span>
        </v-footer>
        <v-snackbar
                :timeout="timeout"
                v-model="show"
                :top="true"
                :right="true"
                :color="color"
        >
            <strong>{{body}}</strong>
        </v-snackbar>
    </v-app>
</template>

<script>
    export default {
        data () {
            return {
                theme: true,
                drawer: null,
                user: '',
                body: '',
                color: 'success',
                show: false,
                timeout: 5000,
            }
        },
        created() {
            this.$store.dispatch('authCheck');
            window.events.$on(
                'flash', data => this.flash(data)
            );
        },
        computed: {
            authCheck: function () {
                return this.$store.state.authCheck;
            }
        },
        methods: {
            flash(data) {
                this.body = data.message;
                this.color = data.color;
                this.show = true;
            }
        }
    }
</script>