import Vue from 'vue';
import Buefy from 'buefy'
import router from './router';
import store from './store';
import axios from 'axios';
import App from './App'
import Messenger from './helpers/Messenger';
import PromiseFinally from 'promise.prototype.finally';

axios.defaults.baseURL = '/api/';
axios.defaults.withCredentials = true;
PromiseFinally.shim();

axios.interceptors.response.use(undefined, (err) => {
    return new Promise(() => {
        switch (err.response.status) {
            case 401:
                store.dispatch('localLogout');
                router.push({ name: 'login' })
                    .then(() => Messenger.warning('Musisz się zalogować'));
                break;
            case 404:
                router.push( { name: 'not-found' });
                break;
            default:
                throw err;
        }
    });
});

Vue.prototype.$http = axios;

Vue.use(Buefy, {
    defaultIconPack: 'fas',
    customIconPacks: {
        'fas': {
            sizes: {
                'default': 'fa-md',
                'is-small': 'fa-sm',
                'is-medium': 'fa-md',
                'is-large': 'fa-lg'
            }
        }
    }
});

new Vue({
    el: '#app',
    store,
    router,
    render: h => h(App)
});
