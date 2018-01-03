//Racing Vods 2 JS

import Vue from 'vue';
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';

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

Vue.use(VueRouter);
Vue.component('layout', layout);


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
        { path: '/races/series/:seriesID/season/:seasonID', component: seasonRaces },
        { path: '/', redirect: '/home' }

    ]
});

const app = new Vue({
    el: '#app',
    router
});
