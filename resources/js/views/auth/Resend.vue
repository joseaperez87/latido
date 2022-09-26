<template>
    <section class="resend">
        <div class="container">
            <div class="title">
                <h1 class="fs-2 fw-bold w-50">{{ t('resendcode') }}</h1>
            </div>
            <div @click="errorMessage = ''" v-if="errorMessage" class="alert alert-danger alert-dismissible fade show"
                 role="alert">
                {{ errorMessage }}
            </div>
            <form @submit.prevent="resend">
                <div class="row">
                    <div class="col-md-10 col-sm-12">
                        <label for="email" class="fw-bold mb-2">{{ t('email_address') }}</label>
                        <div class="input-group input-group-md">
                                                <span class="input-group-text bg-primary border-primary"><font-awesome-icon
                                                    icon="fa-bold fa-at"
                                                    class="text-white"></font-awesome-icon></span>
                            <input required type="text" class="form-control border-primary"
                                   :placeholder="t('email_address')" aria-label="Email"
                                   v-model="v$.email.$model" id="email"
                                   name="name" aria-describedby="email">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12 text-sm-center resendbtn">
                        <button :disabled="v$.email.$invalid" type="submit" class="btn btn-primary">{{t('recover')}}</button>
                    </div>
                </div>

                <div class="input-errors text-danger"
                     v-for="(error, index) of v$.email.$errors" :key="index">
                    <div class="error-msg">- {{ error.$message }}</div>
                </div>
            </form>
            <label>
                <router-link to="/auth/register">
                <font-awesome-icon
                    icon="fa-regular fa-arrow-alt-circle-left"
                    class="text-primary"></font-awesome-icon> {{ t('register') }}</router-link>
            </label>
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
import useVuelidate from "@vuelidate/core";
import {email, helpers, required} from "@vuelidate/validators";
import AuthServices  from "../../services/AuthServices";
import router from "../../router";

import {library} from '@fortawesome/fontawesome-svg-core'
import {faArrowAltCircleLeft} from '@fortawesome/free-regular-svg-icons'
import {faArrowLeft} from '@fortawesome/free-solid-svg-icons'
library.add(faArrowAltCircleLeft)


export default {
    setup() {
        const {t, locale} = useI18n()
        const v$ = useVuelidate()
        return {t, locale, v$}
    },
    validations() {
        return {
            email: {
                required: helpers.withMessage(this.t('validations.required'), required),
                email: helpers.withMessage(this.t('validations.incorrect_email'), email)
            }
        }
    },
    name: "Resend",
    data() {
        return {
            appName: import.meta.env.VITE_APP_NAME,
            date: new Date(),
            email: '',
            errorMessage: '',
        }
    },
    methods:{
        async resend(){
            await this.v$.$validate()
            if (!this.v$.email.$invalid) {
                AuthServices.resend_email(this.email, 0).then(res => {
                    if(!res.res){
                        this.errorMessage = res.message
                    }else{
                        router.push({path: '/auth/success', params: { res: res.res }})
                    }
                })
            }
        }
    }
}
</script>

<style scoped>
    form {
        margin-bottom: 20px;
    }
    .resend {
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
    .resendbtn {
        text-align: left;
        align-self: end;
    }
</style>
