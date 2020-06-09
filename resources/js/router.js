import Vue from 'vue'
import Router from 'vue-router'
import store from './store';
import Messenger from './helpers/Messenger';
import Login from './pages/Auth/Login';
import Register from './pages/Auth/Register';
import NotFound from './pages/Errors/NotFound';
import Home from './pages/Home';
import Event from './pages/Event';
import Events from './pages/Events';
import Players from './pages/Players';
import ProfileLayout from './layouts/ProfileLayout';
import ProfileGeneral from './pages/Profile/ProfileGeneral';
import AdminLayout from './layouts/AdminLayout';
import AdminSystems from './pages/Admin/Systems';
import AdminLanguages from './pages/Admin/Languages';
import AdminTypes from './pages/Admin/Types';

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
            path: '/players',
            component: Players,
            name: 'players',
        },
        {
            path: '/events',
            component: Events,
            name: 'events',
        },
        {
            path: '/events/:id',
            component: Event,
            name: 'event',
        },
        {
            path: '/profile',
            component: ProfileLayout,
            meta: {
                requiresAuth: true,
            },
            redirect: 'profile/general',
            name: 'profile',
            children: [
                { path: '/profile/general', component: ProfileGeneral, name: 'profile.general' },
                { path: '/profile/notifications', component: Home, name: 'profile.notifications' },
                { path: '/profile/events', component: Home, name: 'profile.events' },
                { path: '/profile/history', component: Home, name: 'profile.history' },
                { path: '/profile/friends', component: Home, name: 'profile.friends' },
            ]
        },
        {
            path: '/admin',
            component: AdminLayout,
            meta: {
                requiresAuth: true,
                onlyAdmin: true,
            },
            redirect: '/admin/systems',
            name: 'admin',
            children: [
                { path: '/admin/systems', component: AdminSystems, name: 'admin.systems' },
                { path: '/admin/languages', component: AdminLanguages, name: 'admin.languages' },
                { path: '/admin/types', component: AdminTypes, name: 'admin.types' },
            ]
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
            Messenger.warning('You need to be logged in');
            next('/login');
        }
    } else {
        return next();
    }
});

export default router;
