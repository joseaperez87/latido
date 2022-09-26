import { createRouter, createWebHistory } from "vue-router";
import MainPage from '../views/Main.vue';

import Login from '../views/auth/Login.vue';
import Register from '../views/auth/Register.vue';
import AuthLayout from '../views/auth/Layout.vue'
import RegisterSuccess from '../views/auth/RegisterSuccess.vue'
import Confirmation from '../views/auth/Confirmation.vue'
import Resend from '../views/auth/Resend.vue'
import {authStore} from "../store";

const routes = [
    { path: '/', name: 'MainPage', component: MainPage,
        //children: [{}]
    },
    {
        path: '/auth',
        name: 'AuthLayout',
        component: AuthLayout,
        children: [
            { path: "login", name: "Login", component: Login, meta: { isGuest: true } },
            { path: "register", name: "Register", component: Register, meta: { isGuest: true } },
            { path: "success", name: "RegisterSuccess", component: RegisterSuccess, meta: { isGuest: true }},
            { path: "confirm/:code", name: "Confirm", component: Confirmation, meta: { isGuest: true } },
            { path: "resend", name: "Resend", component: Resend, meta: { isGuest: true } },
        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const store = authStore();
    if(to.meta.requiresAuth && !store.user.token){
        next({name: 'Login'});
    } else if(store.user.token > 0 && to.meta.isGuest){
        next({name: 'MainPage'});
    }else{
        next();
    }
});

export default router
