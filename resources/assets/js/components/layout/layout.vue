<template>
    <v-app id="inspire">
        <v-navigation-drawer
                v-model="drawer"
                app
        >
            <v-img src="/img/logo/racingVods-light.png" style="max-width: 100%;"></v-img>
            <v-divider></v-divider>

            <v-list nav shaped>
                <v-list-item-group ripple exact color="primary">
                    <v-list-item to="/">
                        <v-list-item-icon>
                            <v-icon>mdi-home</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Home</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
                <v-list-item-group ripple exact color="primary">
                    <v-list-item to="/series">
                        <v-list-item-icon>
                            <v-icon>mdi-format-list-bulleted</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Series</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
                <v-list-item-group ripple exact color="primary">
                    <v-list-item to="/races">
                        <v-list-item-icon>
                            <v-icon>mdi-flag-checkered</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Races</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
                <v-list-item-group ripple exact color="primary">
                    <v-list-item to="/tracks">
                        <v-list-item-icon>
                            <v-icon>mdi-road</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Tracks</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
                <v-list-item-group ripple exact color="primary">
                    <v-list-item to="/schedule">
                        <v-list-item-icon>
                            <v-icon>mdi-calendar-range</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Schedule</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
                <v-divider></v-divider>
                <v-subheader>Additional resources</v-subheader>
                <v-list-item-group ripple exact color="primary">
                    <v-list-item to="/about">
                        <v-list-item-icon>
                            <v-icon>mdi-information-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>About</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
                <v-list-group
                        prepend-icon="mdi-account-multiple"
                        no-action
                >
                    <v-list-item-group ripple slot="activator">
                        <v-list-item-content>
                            <v-list-item-title>Community</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item-group>
                    <v-list-item-group ripple>
                        <v-list-item href="https://discord.gg/VT3EpCd" target="_blank">
                            <v-list-item-content>
                                <v-list-item-title>Discord</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                    <!-- TODO: Add donation link -->
                    <!--<v-list-item-group ripple to="">-->
                    <!--<v-list-item-content>-->
                    <!--<v-list-item-title>Donation</v-list-item-title>-->
                    <!--</v-list-item-content>-->
                    <!--<v-list-item-group/-->
                </v-list-group>
                <v-list-item-group ripple exact color="primary">
                    <v-list-item to="/contact-us">
                        <v-list-item-icon>
                            <v-icon>mdi-message-text-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Contact Us</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
                <template v-if="authCheck">
                    <v-divider></v-divider>
                    <v-subheader>Admin</v-subheader>
                    <v-list-item-group ripple to="/dashboard">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon>mdi-account-key</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Dashboard</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                    <v-list-group
                            prepend-icon="mdi-settings"
                            no-action
                    >
                        <v-list-item-group ripple slot="activator">
                            <v-list-item-content>
                                <v-list-item-title>Edit</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item-group>
                        <v-list-item-group ripple to="/add/series">
                            <v-list-item-content>
                                <v-list-item-title>Series</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item-group>
                        <v-list-item-group ripple to="/edit/races">
                            <v-list-item-content>
                                <v-list-item-title>Races</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item-group>
                        <v-list-item-group ripple to="/add/video">
                            <v-list-item-content>
                                <v-list-item-title>Videos</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item-group>
                        <v-list-item-group ripple to="/edit/tracks">
                            <v-list-item-content>
                                <v-list-item-title>Tracks</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item-group>
                    </v-list-group>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar fixed app color="grey darken-4">
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
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
<!--            <v-btn icon>-->
<!--                <v-icon>mdi-wallet-giftcard</v-icon>-->
<!--            </v-btn>-->
        </v-app-bar>
        <v-content class="grey darken-2">
            <div class="pa-2">
                <router-view :key="$route.fullPath"></router-view>
            </div>
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