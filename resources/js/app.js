
require('./bootstrap');

// window.Vue = require('vue').default;
import vuetify from  "../../resources/js/plugins/vuetify";
import "vuetify/dist/vuetify.min.css";


// Vue.use(Vuetify);
import Vue from 'vue'
import router from './router';
import App from './layouts/App.vue';
import store from './store'


const app = new Vue({
    router,
    vuetify,
    store,
    el: '#app',
    render: h => h(App)
});
