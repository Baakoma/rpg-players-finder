<template>
    <div class="container m-20">
        <div class="columns">
            <div class="column is-3 is-flex">
                <div class="menu">
                    <p class="menu-label">
                        General
                    </p>
                    <ul class="menu-list">
                        <li>
                            <router-link :to="{ name: 'admin.systems' }">
                                Systems
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'admin.languages' }">
                                Languages
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'admin.types' }">
                                Types
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="column is-9 is-flex">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>
