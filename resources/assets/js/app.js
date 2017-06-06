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
Vue.http.options.root = 'http://skillhire.dev';
Vue.component('navigation', require('./components/Partials/Navigation.vue'));
import auth from './auth';
var user= {authenticated: false};
router.beforeEach(function (to, from, next) {
    let token = localStorage.getItem('id_token');
    var vue = Vue;
    if (token !== null) {
        Vue.http.get(
            'api/user?token=' + token,
        ).then(response => {
            user.authenticated = true
            user.profile = response.data.data
            if (to.matched.some(record => record.meta.auth)) {
                // this route requires auth, check if logged in
                // if not, redirect to login page.

                if (!user.authenticated) {
                    next({
                        path: '/signin'
                    })
                } else {
                    next()
                }
            } else {
                next() // make sure to always call next()!
            }
        }, (error) => {
            next({
                path: '/signin'
            })
        });
    } else {
        if (to.matched.some(record => record.meta.auth)) {
            next({
                path: '/signin'
            });
        } else {
            next()
        }
    }
})

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

