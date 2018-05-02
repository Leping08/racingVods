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
import createVideo from './components/videos/create';
import createSeries from './components/series/create';
import notFound from './components/not-found/notFound.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: home },
        { path: '/about', component: about },
        { path: '/races', component: races },
        { path: '/series', component: series },
        { path: '/tracks', component: tracks },
        //TODO: Come up with a better schedule
        //{ path: '/schedule', component: schedule },
        { path: '/races/:id', component: raceID },
        { path: '/series/:id', component: seriesID },
        { path: '/tracks/:id', component: tracksID },
        { path: '/edit/tracks', component: createTrack, meta: { requiresAuth: true} },
        { path: '/edit/races', component: createRace, meta: { requiresAuth: true} },
        { path: '/add/video', component: createVideo, meta: { requiresAuth: true} },
        { path: '/add/series', component: createSeries, meta: { requiresAuth: true} },
        { path: '/races/series/:seriesID/season/:seasonID', component: seasonRaces },
        { path: '/login', component: login },
        { path: '/dashboard', component: dashboard },
        { path: '/', redirect: '/home' },
        { path: '/404', component: notFound },
        { path: '/logout', component: logout },
        { path: '*', redirect: '/404' },
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (! window.localStorage.accessToken) {
            next({
                path: '/logout'
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;