//Racing Vods 2 JS

import Vue from 'vue';
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
import moment from 'moment';
import VueAnalytics from 'vue-analytics'

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
import createRace from './components/races/create.vue';

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
        { path: '/home', component: home },
        { path: '/about', component: about },
        { path: '/races', component: races },
        { path: '/series', component: series },
        { path: '/tracks', component: tracks },
        { path: '/schedule', component: schedule },
        { path: '/races/:id', component: raceID },
        { path: '/series/:id', component: seriesID },
        { path: '/tracks/:id', component: tracksID },
        { path: '/add/race', component: createRace },
        { path: '/races/series/:seriesID/season/:seasonID', component: seasonRaces },
        { path: '/', redirect: '/home' }

    ]
});

Vue.use(moment);
Vue.use(require('vue-moment'));
Vue.use(VueRouter);
Vue.component('layout', layout);
Vue.use(VueAnalytics, {
    id: 'UA-98405544-5',
    router
});


const app = new Vue({
    el: '#app',
    router
});
