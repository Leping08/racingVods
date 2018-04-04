import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user: {},
        authCheck: false
    },
    getters: {
        authCheck: state => {
            return  state.authCheck;
        },
        user: state => {
            return state.user;
        }
    },
    mutations: {
        authCheck (state) {
            state.authCheck = !!window.localStorage.accessToken
        }
    },
    actions: {
        authCheck (context) {
            context.commit('authCheck')
        }
    }
});

export default store;