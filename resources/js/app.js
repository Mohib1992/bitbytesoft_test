require('./bootstrap');

import Vue from 'Vue'
import App from '../views/components/App.vue'

Vue.config.devtools = true;

const app = new Vue({
    el: '#app',
    render : h => h(App)
})
