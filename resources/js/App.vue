<template>
    <div class="container-fluid">
        <b-navbar wrapper-class="container" shadow spaced>
            <template slot="brand">
                <b-navbar-item tag="a" href="/">
                    <img src="/images/logo.png" alt="">
                </b-navbar-item>
            </template>
            <template slot="end">
                <b-navbar-item tag="router-link" :to="{ name: 'home' }" v-if="isLoggedIn">
                    Wydarzenia
                </b-navbar-item>
                <b-navbar-item tag="div">
                    <div class="buttons">
                        <router-link class="button is-success" :to="{ name: 'register' }" v-if="!isLoggedIn">
                            Rejestracja
                        </router-link>
                        <router-link class="button is-primary" :to="{ name: 'login' }" v-if="!isLoggedIn">
                            Zaloguj się
                        </router-link>
                        <a class="button is-danger" href="/logout" @click.prevent="logout" v-if="isLoggedIn">
                            Wyloguj się
                        </a>
                    </div>
                </b-navbar-item>
            </template>
        </b-navbar>
        <div class="is-flex justify-content-center align-items-center pt-20">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import Messenger from './helpers/Messenger';

    export default {
        computed: {
            ...mapGetters(['isLoggedIn', 'user'])
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push({ name: 'home' })
                            .then(() => Messenger.info('Wylogowano pomyślnie'))
                            .catch(() => {});
                    })
            }
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
