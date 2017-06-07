/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import VueRouter from 'vue-router';
import App from './components/App.vue';
import VueResource from 'vue-resource';
import {router} from './routes.js';
Vue.use(VueRouter);
Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.getElementsByName('csrf-token')[0].getAttribute('content');
Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token');
Vue.http.options.root = window.BASE_URL ? window.BASE_URL : 'http://skillhire.dev';
Vue.component('navigation', require('./components/Partials/Navigation.vue'));
import auth from './auth';
auth.authBefore();

Vue.extend({
    data: function () {
        return {user: {}};
    },
    computed: {
        auth: function () {
            return auth;
        }
    },
    methods: {
        checkLocalStorage: function () {
            if (localStorage.user) {
                this.user = JSON.parse(localStorage.user);
                Vue.http.headers.common['Authorization'] = 'Bearer ' + this.user.api_token;
                auth.authenticated = true;
            }
        },
        logout: function () {
            this.user = {};
            auth.logout();
        }
    },
    ready: function () {
        this.checkLocalStorage();
    }
});

export default Vue;


const app = new Vue({
    el: '#app',
    router: router,
    render: app => app(App)
});

