require('./bootstrap');

window.Vue = require('vue');
import Vuetify from 'vuetify';
Vue.use(Vuetify);



Vue.component('user', require('./user.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
})
