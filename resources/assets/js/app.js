/**
 * Racing Vods JS
 */

import Vue from 'vue';
import Vuetify from 'vuetify'
import VueCharts from 'vue-chartjs';
import moment from 'moment';
import VueAnalytics from 'vue-analytics';
import VueYoutube from 'vue-youtube';
import store from './vuex';
import layout from './components/layout/layout.vue';
import router from './router';
import api from './auth';
import axios from 'axios'

Vue.use(Vuetify);

Vue.use(api);
Vue.use(moment);
Vue.use(require('vue-moment'));
Vue.component('layout', layout);
Vue.use(VueCharts);
Vue.use(VueYoutube);
Vue.use(VueAnalytics, {
    id: 'UA-98405544-5',
    router
});


/**
 * Axios headers for api requests
 */
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
Vue.prototype.$axios = axios;


const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify: new Vuetify({
        theme: {
            dark: true,
            themes: {
                dark: {
                    "primary": "#00c4a9",
                    "secondary": "#4DB6AC",
                    "accent": "#F44336",
                    "error": "#F44336",
                    "warning": "#ffeb3b",
                    "info": "#2196F3",
                    "success": "#4CAF50"
                }
            }
        }
    })
});
