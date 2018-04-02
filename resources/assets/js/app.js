/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

//Racing Vods 2 JS
import Vue from 'vue';
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
import moment from 'moment';
import VueAnalytics from 'vue-analytics';
import VCalendar from 'v-calendar';

import layout from './components/layout/layout.vue';
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
import notFound from './components/not-found/notFound.vue';

Vue.use(Vuetify, {
    theme: {
        "primary": "#00c4a9",
        "secondary": "#4DB6AC",
        "accent": "#F44336",
        "error": "#F44336",
        "warning": "#ffeb3b",
        "info": "#2196F3",
        "success": "#4CAF50"
    }
});

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
        { path: '/', redirect: '/home' },
        { path: '/404', component: notFound },
        { path: '*', redirect: '/404' },

    ]
});

Vue.use(moment);
Vue.use(require('vue-moment'));
Vue.use(VueRouter);
Vue.component('layout', layout);
Vue.use(VCalendar);
Vue.use(VueAnalytics, {
    id: 'UA-98405544-5',
    router
});


const app = new Vue({
    el: '#app',
    router
});
