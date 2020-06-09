<template>
    <div class="container" >
        <div class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Błąd 404
                    </h1>
                    <h2 class="subtitle">
                        Strona, której szukasz nie istnieje
                    </h2>
                </div>
            </div>
        </div>
        <div class="section pl-0 pr-0">
            <p class="notification is-primary">
                Sprawdź czy podałeś na pewno dobry adres, albo <router-link :to="{ name: 'home' }">wróć do strony głównej</router-link>.
            </p>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>
