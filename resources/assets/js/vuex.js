import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        userName: null,
        userId: null,
        authCheck: false
    },
    getters: {
        authCheck: state => {
            return  state.authCheck;
        },
        userName: state => {
            return state.userName;
        },
        userId: state => {
            return state.userId;
        }
    },
    mutations: {
        authCheck (state) {
            state.authCheck = !!window.localStorage.accessToken
        },
        setUser (state) {
            this._vm.$api.get('/api/user')
                .then((response) => {
                    state.userName = response.data.name;
                    state.userId = response.data.id;
                })
                .catch((e) => {
                    console.log(e);
                });
        },
        logout (state) {
            state.authCheck = false;
            state.user = null
        }
    },
    actions: {
        authCheck (context) {
            context.commit('authCheck')
        },
        setUser (context) {
            context.commit('setUser')
        }
    }
});

export default store;