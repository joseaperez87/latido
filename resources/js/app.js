// app.js
import 'bootstrap/dist/css/bootstrap.min.css';
import './assets/sass/styles.sass'

import {createApp} from 'vue'

import App from './App.vue' 

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

createApp(App).component('font-awesome-icon', FontAwesomeIcon).mount("#app")
import 'bootstrap/dist/js/bootstrap.min.js'
