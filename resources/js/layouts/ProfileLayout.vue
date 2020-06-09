<template>
    <div class="container">
        <div class="columns">
            <div class="column is-3">
                <figure class="image is-square mb-10">
                    <img src="/images/avatar.jpg" alt="">
                </figure>
                <h2 class="has-text-centered is-size-3">{{ user.name }}</h2>
                <p class="has-text-centered has-text-weight-bold">
                    {{ user.email }}
                </p>
            </div>
            <div class="column is-9">
                <nav class="tabs is-centered is-boxed">
                    <ul>
                        <router-link tag="li" :to="{ name: 'profile.general' }">
                            <a>
                                <span class="icon is-small"><i class="fas fa-info"></i></span>
                                <span>General</span>
                            </a>
                        </router-link>
                        <router-link tag="li" :to="{ name: 'profile.notifications' }">
                            <a>
                                <span class="icon is-small"><i class="fas fa-bell"></i></span>
                                <span>Notifications</span>
                            </a>
                        </router-link>
                        <router-link tag="li" :to="{ name: 'profile.events' }">
                            <a>
                                <span class="icon is-small"><i class="fas fa-calendar"></i></span>
                                <span>Events</span>
                            </a>
                        </router-link>
                        <router-link tag="li" :to="{ name: 'profile.friends' }">
                            <a>
                                <span class="icon is-small"><i class="fas fa-user-friends"></i></span>
                                <span>Friends</span>
                            </a>
                        </router-link>
                        <router-link tag="li" :to="{ name: 'profile.history' }">
                            <a>
                                <span class="icon is-small"><i class="fas fa-stream"></i></span>
                                <span>History</span>
                            </a>
                        </router-link>
                    </ul>
                </nav>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        computed: {
            ...mapGetters(['user'])
        },
    }
</script>
