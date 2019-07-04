import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const about = () => import('./components/about/about.vue');
const home = () => import('./components/home/home.vue');
const dashboard = () => import('./components/dashboard/dashboard.vue');
const notFound = () => import('./components/not-found/notFound.vue');

const logout = () => import('./components/admin/logout.vue');
const login = () => import('./components/admin/login.vue');

const races = () => import('./components/races/races.vue');
const raceID = () => import('./components/races/raceID.vue');
const createRace = () => import('./components/races/create.vue');

const series = () => import('./components/series/series.vue');
const seriesID = () => import('./components/series/seriesID.vue');
const createSeries = () => import('./components/series/create.vue');
const seriesAdmin = () => import('./components/series/seriesAdmin.vue');

const tracks = () => import('./components/tracks/tracks.vue');
const tracksID = () => import('./components/tracks/tracksID.vue');
const createTrack = () => import('./components/tracks/create.vue');

const seasonRaces = () => import('./components/season/seasonRaces.vue');
const createVideo = () => import('./components/videos/create.vue');

const schedule = () => import('./components/calendar/schedule.vue');

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
        { path: '/edit/tracks', component: createTrack, meta: { requiresAuth: true} },
        { path: '/edit/races', component: createRace, meta: { requiresAuth: true} },
        { path: '/add/video', component: createVideo, meta: { requiresAuth: true} },
        { path: '/add/series', component: createSeries, meta: { requiresAuth: true} },
        { path: '/admin/series', component: seriesAdmin, meta: { requiresAuth: true} },
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