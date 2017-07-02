import Vue from './app.js';
import {router} from './routes.js';

export default {
    user: {
        authenticated: false,
        profile: null
    },
    authBefore() {
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
                    localStorage.removeItem('id_token');
                    localStorage.removeItem('client');
                    next({
                        path: '/signin'
                    })
                });
            } else {
                if (to.matched.some(record => record.meta.auth)) {
                    localStorage.removeItem('id_token');
                    localStorage.removeItem('client');
                    next({
                        path: '/signin'
                    });
                } else {
                    next()
                }
            }
        })
    },
    check() {
        let token = localStorage.getItem('id_token');
        var vue = Vue;
        if (token !== null) {
            Vue.http.get(
                'api/user?token=' + token,
            ).then(response => {
                this.user.authenticated = true
                this.user.profile = response.data.data
                localStorage.setItem('client', response.data.data.name);
            })
        }
    },
    register(context, name, email, password) {
        Vue.http.post(
            'api/register',
            {
                name: name,
                email: email,
                password: password
            }
        ).then(response => {
            context.success = true
        }, response => {
            localStorage.removeItem('id_token');
            localStorage.removeItem('client');
            context.response = response.data;
            context.error = true;
        })
    },
    signin(context, email, password) {
        Vue.http.post(
            'api/signin',
            {
                email: email,
                password: password
            }
        ).then(response => {
            context.error = false
            localStorage.setItem('id_token', response.data.meta.token);
            localStorage.setItem('client', response.data.meta.name);
            Vue.http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token')

            this.user.authenticated = true
            this.user.profile = response.data.data

            router.push({
                name: 'vacancies'
            })
        }, response => {
            localStorage.removeItem('id_token');
            localStorage.removeItem('client');
            context.error = true
        })
    },
    signout() {
        localStorage.removeItem('id_token')
        localStorage.removeItem('client')
        this.user.authenticated = false
        this.user.profile = null

        router.push({
            name: 'home'
        })
    },
    loggedIn() {
        return this.user.authenticated;
    }
}