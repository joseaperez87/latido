<template>
    <section class="login-section">
        <div class="container login-form row">
            <div class="col-md-4 col-sm-12">
                <div class="logo text-center">
                    <img src="../../assets/images/logo-short-sm.png">
                </div>
                <div @click="errorMsg = ''" v-if="errorMsg" class="alert alert-danger alert-dismissible fade show"
                     role="alert">
                    {{ errorMsg }}
                </div>
                <form @submit.prevent="login">
                    <div class="input-group input-group-md mb-2">
                        <input required type="email" class="form-control border-primary"
                               :placeholder="t('email_address')" aria-label="Email" v-model="v$.email.$model" id="email"
                               name="email" aria-describedby="username">
                        <span class="input-group-text bg-primary border-primary" id="email"><font-awesome-icon
                            icon="fa-regular fa-user" class="text-white"></font-awesome-icon></span>
                    </div>
                    <div class="input-errors text-danger" v-for="(error, index) of v$.email.$errors" :key="index">
                        <div class="error-msg">- {{ error.$message }}</div>
                    </div>
                    <div class="input-group input-group-md mb-2">
                        <input required :type="showPass" class="form-control border-primary"
                               :placeholder="t('password')" v-model="v$.password.$model" aria-label="Username" id="password"
                               name="password" aria-describedby="username">
                        <span class="input-group-text bg-primary border-primary" id="password"
                              @click="changeVisibility">
                            <font-awesome-icon v-if="showPass == 'password'" icon="fa-regular fa-eye"
                                               class="text-white"></font-awesome-icon>
                            <font-awesome-icon v-if="showPass == 'text'" icon="fa-regular fa-eye-slash"
                                           class="text-white"></font-awesome-icon>
                        </span>
                    </div>
                    <div class="input-errors text-danger" v-for="(error, index) of v$.password.$errors" :key="index">
                        <div class="error-msg">- {{ error.$message }}</div>
                    </div>
                    <div class="form-check mb-3">
                        <input v-model="remember" class="form-check-input" type="checkbox" value=""
                               id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ t('remember') }}
                        </label>
                        <a href="#" class="fa-pull-right" data-bs-toggle="modal"
                           data-bs-target="#forgot-password">{{ t('forgot_p') }}</a>
                    </div>
                    <button :disabled="v$.email.$invalid || v$.password.$invalid" class="btn btn-primary">{{ t('login') }}</button>
                </form>
                <p>{{ t('new_account_text') }} <div class="link-container"><router-link to="register">{{ t('register') }} </router-link></div></p>
            </div>
        </div>
        <div class="image-container"></div>
        <footer>
            <div class="container">
                &copy; {{ appName }} - {{ date.getFullYear() }}
            </div>
        </footer>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="forgot-password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ t('recover_p') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input required type="email" class="form-control border-primary"
                           :placeholder="t('email_address')" aria-label="Email" v-model="email" id="username"
                           name="email" aria-describedby="username">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">{{ t('recover') }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {library} from '@fortawesome/fontawesome-svg-core'
import {faUser, faEye, faEyeSlash} from '@fortawesome/free-regular-svg-icons'
import {faVk, faGoogle, faApple, faWindows} from '@fortawesome/free-brands-svg-icons'
import {useRouter} from 'vue-router';
import {useI18n} from 'vue-i18n'
import {useCookies} from "vue3-cookies";
import useVuelidate from '@vuelidate/core'
import {required, email, minLength, helpers} from '@vuelidate/validators'

library.add(faUser, faEye, faEyeSlash, faVk, faGoogle, faApple, faWindows);

export default {
    name: "Login",
    setup: () => {
        const {t, locale} = useI18n()
        const v$ = useVuelidate()
        const router = useRouter()
        const {cookies} = useCookies()
        cookies.set('lang', locale.value)
        return {t, locale, router, cookies, v$}

    },
    data() {
        return {
            email: '',
            password: '',
            remember: false,
            errorMsg: '',
            showPass: 'password',
            date: new Date(),
            appName: import.meta.env.VITE_APP_NAME,
        }
    },
    validations() {
        return {
            email: {
                required: helpers.withMessage(this.t('validations.required'), required),
                email: helpers.withMessage(this.t('validations.incorrect_email'), email)
            },
            password: {
                required: helpers.withMessage(this.t('validations.required'), required),
                min: helpers.withMessage(this.t('validations.minLength',{min : 6}), minLength(6))
            }
        }
    },
    methods: {
        login() {
            if(v$.email.$invalid || v$.password.$invalid){
                return;
            }

        },
        changeVisibility() {
            this.showPass = this.showPass == 'password' ? 'text' : 'password';
        }
    }
}
</script>

<style scoped>

</style>
