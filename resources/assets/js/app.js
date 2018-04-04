/**
 * Axios headers for api requests
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


/**
 * Racing Vods 2 JS
 */

import Vue from 'vue';
import Vuetify from 'vuetify';
import moment from 'moment';
import VueAnalytics from 'vue-analytics';
import VCalendar from 'v-calendar';
import store from './vuex';
import layout from './components/layout/layout.vue';
import router from './router';
import api from './auth';

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

Vue.use(api);
Vue.use(moment);
Vue.use(require('vue-moment'));
Vue.component('layout', layout);
Vue.use(VCalendar);
Vue.use(VueAnalytics, {
    id: 'UA-98405544-5',
    router
});


const app = new Vue({
    el: '#app',
    router,
    store
});
