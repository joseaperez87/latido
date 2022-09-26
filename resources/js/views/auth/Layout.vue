<template>
    <nav class="nav nav-justified nav-login">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex">
                    <div class="logo text-center">
                        <img src="../../assets/images/logo-short-sm.png">
                    </div>
                    <div class="link-container"><router-link to="/">{{ t('home') }} </router-link></div>
                </div>
                <div class="offset-md-4 col-md-4 col-sm-12 text-center">
                    <div class="btn-group lang-group" role="group" aria-label="Basic outlined example">
                        <button @click="set_locale('en')" type="button" :class="{btn:true, 'btn-primary': true, active:(locale == 'en')}">EN</button>
                        <button @click="set_locale('ru')" type="button" :class="{btn:true, 'btn-primary': true, active:(locale == 'ru')}"><strong>РУ</strong></button>
                        <button @click="set_locale('es')" type="button" :class="{btn:true, 'btn-primary': true, active:(locale == 'es')}">ES</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <router-view></router-view>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import { useCookies } from "vue3-cookies";
const { cookies } = useCookies();

const {t, locale} = useI18n();

function set_locale(local){
    locale.value = local;
    console.log(local)
    cookies.set('lang', local);
}
</script>>

<style scoped>

</style>
