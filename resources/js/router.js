import Vue from 'vue'
import Router from 'vue-router'
import store from './store';
import Messenger from './helpers/Messenger';
import Login from './pages/Auth/Login';
import Register from './pages/Auth/Register';
import NotFound from './pages/Errors/NotFound';
import Home from './pages/Home';


Vue.use(Router);

let router = new Router({
    mode: 'history',

    linkActiveClass: 'is-active',

    routes: [
        {
            path: '/',
            component: Home,
            name: 'home',
        },
        {
            path: '/login',
            component: Login,
            name: 'login',
        },
        {
            path: '/register',
            component: Register,
            name: 'register',
        },
        {
            path: '*',
            component: NotFound,
            name: 'not-found'
        },
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            return next();
        } else {
            Messenger.warning('Strona wymaga logowania');
            next('/login');
        }
    } else {
        return next();
    }
});

export default router;
