<template>
    <section class="success-page">
        <div class="container">
            <div class="title">
                <h1 class="fs-2 fw-bold w-50">{{ t('register_success.head') }}</h1>
            </div>
            <div class="alert alert-success text">
                <p>{{ t('register_success.text') }}</p>
            </div>
        </div>
    </section>
    <footer>
        <div class="container mt-2 text-center">
            &copy; {{ appName }} - {{ date.getFullYear() }}
        </div>
    </footer>
</template>

<script>
import {useI18n} from 'vue-i18n'

export default {
    setup() {
        const {t, locale} = useI18n()
        return {t, locale}
    },
    name: "RegisterSuccess",
    data() {
        return {
            appName: import.meta.env.VITE_APP_NAME,
            date: new Date(),
        }
    }
}
</script>

<style scoped>
    .success-page {
        margin-top: 100px;
    }
    .success-page .text {
        height: 250px;
        display: flex;
        align-items: center;
    }
    footer {
        margin-top: 20px;
    }
    footer .container {
        padding-top: 20px;
        border-top: 1px solid rgba(0,0,0,.2);
    }
</style>
