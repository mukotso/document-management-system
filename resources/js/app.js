

require('./bootstrap');

window.Vue = require('vue');


Vue.component('OuterNav', require('./components/Shared/OuterNav.vue').default);
Vue.component('Analytics', require('./components/Analytics').default);
Vue.component('Login', require('./components/Auth/Login').default);
Vue.component('Register', require('./components/Auth/Register').default);


const app = new Vue({
    el: '#app',
});
