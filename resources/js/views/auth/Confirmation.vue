<template>
    <section class="confirmation">
        <div class="container">
            <div class="title">
                <h1 class="fs-2 fw-bold w-50">{{ t('register_success.head') }}</h1>
            </div>
            <div :class="'alert '+classt">
                <p>{{message}} <label><router-link to="/auth/resend">{{t('resend_it')}}</router-link></label></p>
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
    name: "Confirmation",
    data() {
        return {
            appName: import.meta.env.VITE_APP_NAME,
            date: new Date(),
            message : confirm_message,
            result : confirm_result,
            classt: ''
        }
    },
    mounted() {
       this.classt = 'alert-success'
       if(this.result == 'false'){
           this.classt = 'alert-danger'
       }
    }
}
</script>

<style scoped>
    .confirmation {
        margin-top: 100px;
    }
    .confirmation .text {
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
