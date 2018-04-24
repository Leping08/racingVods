import Vue from 'vue';
import axios from 'axios';
import router from './router';

//User AccessToken Functions
window.setAccessToken = function (accessToken) {
    window.localStorage.accessToken = accessToken;
};

window.getAccessToken = function () {
    return window.localStorage.accessToken;
};

//Global Flash Message
window.events = new Vue();
window.flash = function (message, color = 'blue') {
    window.events.$emit('flash', { message, color });
};

function http() {
    //Create an axios instance and apply all auth necessary to make api calls
    let http = axios.create();
    http.defaults.headers.common['Authorization'] = "Bearer " + window.getAccessToken();
    http.defaults.headers.common['Accept'] = 'application/json';
    http.defaults.headers.post['Content-Type'] = 'application/json';

    //Intercept all 401 "unauthenticated" requests and kick the user back to the login screen
    http.interceptors.response.use(function (response) {
        return response;
    }, function (error) {
        if (error.response.status === 401) {
            window.setAccessToken('');
            router.push('/login');
        } else {
            throw error;
        }
    });
    return http;
}

export default function (Vue) {
    Object.defineProperties(Vue.prototype, {
        $api: {
            get () {
                return http();
            }
        }
    });
}
