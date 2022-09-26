// app.js
import 'bootstrap/dist/css/bootstrap.min.css';
import './assets/sass/styles.sass'
import router from './router'
import i18n from './i18n'
import App from './App.vue'
import { createPinia } from 'pinia';
import { createApp} from 'vue'

/* import font awesome icon component */
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'

var app = createApp(App)
    .use(router)
    .use(i18n)
    .use(createPinia())
    .component('font-awesome-icon', FontAwesomeIcon)
    .mount("#app")

import 'bootstrap/dist/js/bootstrap.min.js'
