<template>
    <div class="container-fluid">
        <b-navbar wrapper-class="container" shadow spaced>
            <template slot="brand">
                <b-navbar-item tag="a" href="/">
                    <img src="/images/logo.png" alt="">
                </b-navbar-item>
            </template>
            <template slot="end">
                <b-button type="is-primary" v-if="isLoggedIn" @click="creatingEvent = true">
                    Create event
                </b-button>
                <b-navbar-item tag="router-link" :to="{ name: 'admin' }" v-if="isLoggedIn && isAdmin">
                    Admin panel
                </b-navbar-item>
                <b-navbar-item tag="router-link" :to="{ name: 'events' }">
                    Search events
                </b-navbar-item>
                <b-navbar-item tag="router-link" :to="{ name: 'players' }">
                    Search players
                </b-navbar-item>
                <b-navbar-item tag="router-link" :to="{ name: 'profile' }" v-if="isLoggedIn">
                    Profile
                </b-navbar-item>
                <b-navbar-item tag="div">
                    <div class="buttons">
                        <router-link class="button is-success" :to="{ name: 'register' }" v-if="!isLoggedIn">
                            Sign up
                        </router-link>
                        <router-link class="button is-info" :to="{ name: 'login' }" v-if="!isLoggedIn">
                            Sign in
                        </router-link>
                        <a class="button is-danger" href="/logout" @click.prevent="logout" v-if="isLoggedIn">
                            Logout
                        </a>
                    </div>
                </b-navbar-item>
            </template>
        </b-navbar>
        <div class="is-flex justify-content-center align-items-center pt-20">
            <router-view></router-view>
        </div>
        <b-modal :active.sync="creatingEvent"
                 trap-focus
                 has-modal-card
                 :destroy-on-hide="false">
            <create-event-modal></create-event-modal>
        </b-modal>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import Messenger from './helpers/Messenger';
    import CreateEventModal from './components/CreateEventModal';

    export default {
        components: {
          CreateEventModal,
        },
        computed: {
            ...mapGetters(['isLoggedIn', 'isAdmin', 'user'])
        },
        data() {
            return {
                creatingEvent: false,
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push({ name: 'home' })
                            .then(() => Messenger.info('You have been logged out'))
                            .catch(() => {});
                    })
            },
        }
    }
</script>

<style lang="scss">
    .navbar-menu a.navbar-item.is-active {
        font-weight: bold;
    }

    .navbar-item {
        &.has-dropdown {
            .navbar-dropdown {
                display: none;
            }
        }
        &.is-active {
            .navbar-dropdown {
                display: block;
            }
        }
    }
</style>
