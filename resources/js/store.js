import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

const user = JSON.parse(localStorage.getItem('user'));

const initialState = user
    ? { loggedIn: true, user }
    : { loggedIn: false, user: null };

export default new Vuex.Store({
    state: initialState,
    actions: {
        login({ commit }, user) {
            return axios.post('/login',  user)
                .then(() => {
                    return axios.get('/user')
                        .then(({data}) => {
                            commit('authSuccess', data);
                            localStorage.setItem('user', JSON.stringify(data));

                            return Promise.resolve(data);
                        })
                })
                .catch((error) => {
                    commit('authError');

                    return Promise.reject(error);
                });
        },
        register({ commit }, user) {
            return axios.post('/register', user)
                .then((response) => {
                    commit('authSuccess', response.data);
                    localStorage.setItem('user', JSON.stringify(response.data));

                    return Promise.resolve(response.data);
                });
        },
        logout({ commit }) {
            return axios.post('/logout')
                .then(() => {
                    commit('logout');
                    localStorage.removeItem('user');

                    return Promise.resolve();
                })
                .catch((error) => {
                    commit('authError');

                    return Promise.reject(error);
                });
        },
        localLogout({commit}) {
            commit('logout');
            localStorage.removeItem('user');
        },
    },
    mutations: {
        authSuccess(state, user) {
            state.loggedIn = true;
            state.user = user;
        },
        authError(state) {
            state.loggedIn = false;
            state.user = null;
        },
        logout(state){
            state.loggedIn = false;
            state.user = null;
        },
    },
    getters : {
        isLoggedIn(state) {
            return state.loggedIn;
        },
        isAdmin(state) {
            return state.user.role === 1;
        },
        user(state) {
            return state.user;
        },
    }
});
