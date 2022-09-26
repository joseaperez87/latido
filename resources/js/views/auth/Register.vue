<template>
    <section class="register-section">
        <div class="container">
            <form @submit.prevent="register">
                <div class="row">
                    <div class="offset-md-2 col-md-8">
                        <div class="register-form shadow">
                            <div class="container">
                                <div class="title mb-4">
                                    <h1 class="fs-2 fw-bold w-50">{{ t('register') }}</h1>
                                </div>
                                <div class="row">
                                    <div :class="nameClass">
                                        <label for="name" class="fw-bold mb-2">{{ t('name') }}</label>
                                        <div class="input-group input-group-md">
                                                <span class="input-group-text bg-primary border-primary"><font-awesome-icon
                                                    icon="fa-regular fa-user"
                                                    class="text-white"></font-awesome-icon></span>
                                            <input required type="text" class="form-control border-primary"
                                                   :placeholder="t('name')" aria-label="Name"
                                                   v-model="v$.form.name.$model" id="name"
                                                   name="name" aria-describedby="name">
                                        </div>
                                        <div class="input-errors text-danger"
                                             v-for="(error, index) of v$.form.name.$errors" :key="index">
                                            <div class="error-msg">- {{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div :class="nameClass">
                                        <label for="lastname" class="fw-bold mb-2">{{ t('lastname') }}</label>
                                        <div class="mb-md-4">
                                            <input required type="text" class="form-control border-primary"
                                                   :placeholder="t('lastname')" aria-label="Lastname"
                                                   v-model="v$.form.lastname.$model" id="lastname"
                                                   name="name" aria-describedby="lastname">
                                            <div class="input-errors text-danger"
                                                 v-for="(error, index) of v$.form.lastname.$errors" :key="index">
                                                <div class="error-msg">- {{ error.$message }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div :class="nameClass" v-if="locale == 'ru'">
                                        <label for="otchestvo" class="fw-bold mb-2">{{ t('otchestvo') }}</label>
                                        <div class="mb-md-4">
                                            <input required type="text" class="form-control border-primary"
                                                   :placeholder="t('otchestvo')" aria-label="Otchestvo"
                                                   v-model="v$.form.otchestvo.$model" id="otchestvo"
                                                   name="name" aria-describedby="otchestvo">
                                            <div class="input-errors text-danger"
                                                 v-for="(error, index) of v$.form.otchestvo.$errors" :key="index">
                                                <div class="error-msg">- {{ error.$message }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="fw-bold mb-2">{{ t('email_address') }}</label>
                                        <div class="input-group input-group-md">
                                                <span class="input-group-text bg-primary border-primary"><font-awesome-icon
                                                    icon="fa-bold fa-at"
                                                    class="text-white"></font-awesome-icon></span>
                                            <input required type="text" class="form-control border-primary"
                                                   :placeholder="t('email_address')" aria-label="Email"
                                                   v-model="v$.form.email.$model" id="email"
                                                   @keyup="check_email"
                                                   @focusout="check_email"
                                                   name="name" aria-describedby="email">
                                        </div>
                                        <div class="input-errors text-danger"
                                             v-for="(error, index) of v$.form.email.$errors" :key="index">
                                            <div class="error-msg">- {{ error.$message }}</div>
                                        </div>
                                        <div class="input-errors text-danger" v-if="!validEmail">
                                            {{ t('validations.email_busy') }}
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-md-4">
                                        <label for="password" class="fw-bold mb-2">{{ t('password') }}</label>
                                        <div class="input-group input-group-md">
                                            <span class="input-group-text bg-primary border-primary"><font-awesome-icon
                                                icon="fa-bold fa-fingerprint"
                                                class="text-white"></font-awesome-icon></span>
                                            <input required :type="showPass" class="form-control border-primary"
                                                   :placeholder="t('password')" v-model="v$.form.password.$model"
                                                   aria-label="Username" id="password"
                                                   name="password" aria-describedby="password">
                                        </div>
                                        <div class="input-errors text-danger"
                                             v-for="(error, index) of v$.form.password.$errors" :key="index">
                                            <div class="error-msg">- {{ error.$message }}</div>
                                        </div>
                                        <div class="input-errors text-danger"
                                             v-for="(error, index) of passwordErr"
                                             :key="index">
                                            <div class="error-msg">- {{ error }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-md-4">
                                        <label for="password_confirmation " class="fw-bold mb-2">{{
                                                t('confirm_p')
                                            }}</label>
                                        <div class="input-group input-group-md">
                                            <input required :type="showPass" class="form-control border-primary"
                                                   :placeholder="t('confirm_p')"
                                                   v-model="v$.form.password_confirmation .$model"
                                                   aria-label="Username" id="password_confirmation "
                                                   name="password_confirmation " aria-describedby="password_confirmation ">
                                            <span class="input-group-text bg-primary border-primary"
                                                  id="password_confirmation "
                                                  @click="changeVisibility">
                                                    <font-awesome-icon v-if="showPass == 'password'"
                                                                       icon="fa-regular fa-eye"
                                                                       class="text-white"></font-awesome-icon>
                                                    <font-awesome-icon v-if="showPass == 'text'"
                                                                       icon="fa-regular fa-eye-slash"
                                                                       class="text-white"></font-awesome-icon>
                                                </span>
                                        </div>
                                        <div class="input-errors text-danger"
                                             v-for="(error, index) of v$.form.password_confirmation .$errors"
                                             :key="index">
                                            <div class="error-msg">- {{ error.$message }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check mt-3 mb-3">
                                            <input @change="checkTerms" v-model="form.terms" class="form-check-input" type="checkbox" value=""
                                                   id="flexCheckDefault">
                                            <label v-if="!termsError" class="form-check-label" for="flexCheckDefault">
                                                {{ t('terms_conditions') }}
                                            </label>
                                            <label v-if="termsError" class="form-check-label text-danger" for="flexCheckDefault">
                                                {{ t('terms_conditions') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-2 mb-4">
                                        <button class="btn btn-primary reg-btn">
                                            <font-awesome-icon icon="fa-bold fa-angle-double-right"
                                                               class="text-white"></font-awesome-icon>
                                            {{ t('register') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="gologin text-center">
                                    <div class="link-container m-lg-auto">
                                        <router-link to="/auth/login">{{ t('click-to-login') }}</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
import {library} from '@fortawesome/fontawesome-svg-core'
import {faUser, faEye, faEyeSlash} from '@fortawesome/free-regular-svg-icons'
import {faFingerprint, faAngleDoubleRight, faAt} from '@fortawesome/free-solid-svg-icons'
import useVuelidate from '@vuelidate/core'
import {required, email, minLength, maxLength, helpers, sameAs, requiredIf} from '@vuelidate/validators'
import AuthServices from '../../services/AuthServices'
import { authStore } from "../../store";

library.add(faUser, faEye, faEyeSlash, faAt, faFingerprint, faAngleDoubleRight);

export default {
    name: "Register",
    setup() {
        const {t, locale} = useI18n()
        const v$ = useVuelidate()
        const store = authStore();
        return {t, locale, v$, store}
    },
    validations() {
        return {
            form: {
                name: {
                    required: helpers.withMessage(this.t('validations.required'), required),
                    maxLength: helpers.withMessage(this.t('validations.maxLength', {max: 100}), maxLength(100)),
                },
                lastname: {
                    required: helpers.withMessage(this.t('validations.required'), required),
                    maxLength: helpers.withMessage(this.t('validations.maxLength', {max: 100}), maxLength(100)),
                },
                otchestvo: {
                    required: helpers.withMessage(this.t('validations.required'), requiredIf(this.locale.value == 'ru')),
                    maxLength: helpers.withMessage(this.t('validations.maxLength', {max: 100}), maxLength(100)),
                },
                email: {
                    required: helpers.withMessage(this.t('validations.required'), required),
                    email: helpers.withMessage(this.t('validations.incorrect_email'), email)
                },
                password: {
                    required: helpers.withMessage(this.t('validations.required'), required),
                    min: helpers.withMessage(this.t('validations.minLength', {min: 8}), minLength(8)),
                    containsPasswordRequirement: helpers.withMessage(
                        () => this.t('validations.password_requirements'),
                        (value) => /(?=.*[a-zа-я])(?=.*[A-ZА-Я])(?=.*[0-9])(?=.*[!@#\$%\^&\*])/.test(value)
                    )
                },
                password_confirmation : {
                    required: helpers.withMessage(this.t('validations.required'), required),
                    min: helpers.withMessage(this.t('validations.minLength', {min: 8}), minLength(8)),
                    sameAs: helpers.withMessage(this.t('validations.pnotmatch'), sameAs(this.form.password))
                }
            }
        }
    },
    beforeCreate() {
        if (this.locale == 'ru') {
            this.nameClass = 'col-md-4'
        }
    },
    watch: {
        locale:
            {
                handler: function (newval) {
                    if (newval == 'ru') {
                        this.nameClass = 'col-md-4'
                    } else {
                        this.nameClass = 'col-md-6'
                    }
                }
            }
    },
    data() {
        return {
            form: {
                name: '',
                lastname: '',
                otchestvo: '',
                email: '',
                password: '',
                password_confirmation : '',
                terms: false,
            },
            showPass: 'password',
            nameClass: 'col-md-6',
            validEmail: true,
            date: new Date(),
            appName: import.meta.env.VITE_APP_NAME,
            termsError: false,
            passwordErr: {}
        }
    },
    methods: {
        async register() {
            if(!this.form.terms || !this.validEmail){
                this.termsError = true;
                return;
            }
            this.passwordErr = {}
            await this.v$.$validate()
            if (!this.v$.form.$invalid) {
                this.store.register(this.form)
                    .then((data) => {
                        console.log(data)
                        if (data.registered){
                            return router.push('/auth/success');
                        }
                        if(data.password){
                            return this.passwordErr = data.password
                        }
                    })
            }
            this.termsError = false;
        },
        checkTerms(){
            this.termsError = !this.form.terms
        },
        changeVisibility() {
            this.showPass = this.showPass == 'password' ? 'text' : 'password';
        },
        async check_email() {
            if (!this.v$.form.email.$invalid) {
                AuthServices.check_email(this.form.email).then(data => {
                    console.log(data.result)
                    this.validEmail = !data.result ? true : false;
                }).catch(error => {
                    this.errorMsg = error.message
                })
            }
        }
    }

}
</script>

<style scoped>
.reg-btn svg {
    margin-right: 5px;
}
</style>
