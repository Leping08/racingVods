import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import races from './components/races/races.vue';
import raceID from './components/races/raceID.vue';
import series from './components/series/series.vue';
import schedule from './components/schedule/schedule.vue';
import about from './components/about/about.vue';
import seriesID from './components/series/seriesID.vue';
import seasonRaces from './components/season/seasonRaces.vue';
import home from './components/home/home.vue';
import tracks from './components/tracks/tracks.vue';
import tracksID from './components/tracks/tracksID.vue';
import createTrack from './components/tracks/create.vue';
import createRace from './components/races/create.vue';
import login from './components/admin/login.vue';
import logout from './components/admin/logout';
import dashboard from './components/dashboard/dashboard';
import notFound from './components/not-found/notFound.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: home },
        { path: '/about', component: about },
        { path: '/races', component: races },
        { path: '/series', component: series },
        { path: '/tracks', component: tracks },
        { path: '/schedule', component: schedule },
        { path: '/races/:id', component: raceID },
        { path: '/series/:id', component: seriesID },
        { path: '/tracks/:id', component: tracksID },
        { path: '/add/track', component: createTrack },
        { path: '/add/race', component: createRace },
        { path: '/races/series/:seriesID/season/:seasonID', component: seasonRaces },
        { path: '/login', component: login },
        { path: '/dashboard', component: dashboard },
        { path: '/', redirect: '/home' },
        { path: '/404', component: notFound },
        { path: '/logout', component: logout },
        { path: '*', redirect: '/404' },
    ]
});

export default router;