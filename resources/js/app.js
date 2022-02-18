
require('./bootstrap');

import Vue from 'vue'
// window.Vue = require('vue').default;
import vuetify from  "../../resources/js/plugins/vuetify";
import "vuetify/dist/vuetify.min.css";

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

//global filter
Vue.filter("formatDate", function (value) {
    return moment(value).format('MMMM Do YYYY, h:mm:ss a')
});

// Vue.use(Vuetify);
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
