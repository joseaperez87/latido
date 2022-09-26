<template>
    <div class="container">
        <font-awesome-icon icon="fa-solid fa-user-secret"></font-awesome-icon>
        Hello!! How To Install Vue 3 in Laravel 9 with Vite - TechvBlogs
    </div>
    <router-view></router-view>
</template>

<script>

import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
library.add(faUserSecret);
export default {
    name: "MainPage"
}
</script>

<style scoped>

</style>
