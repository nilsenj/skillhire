<template>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Skillhire</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <router-link :to="{ name: 'home' }">Home</router-link>
                    </li>
                    <li>
                        <router-link :to="'/proposals/all'">Proposals</router-link>
                    </li>
                    <li>
                        <router-link :to="'/vacancies/all'">Vacancies</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'employees' }">Employees</router-link>
                    </li>
                    <li>
                        <router-link v-if="auth.user.roles.display_name == 'employer'"  :to="{ name: 'employers' }">Employers</router-link>
                    </li>
                    <li>
                        <router-link v-if="auth.user.roles.display_name == 'admin'"  :to="{ name: 'admin' }">Admin Page</router-link>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li class="pull-right" v-if="!auth.user.authenticated">
                        <router-link :to="{ name: 'register' }">Register</router-link>
                    </li>
                    <li class="pull-right" v-if="!auth.user.authenticated">
                        <router-link :to="{ name: 'signin' }">Sign in</router-link>
                    </li>
                    <li class="pull-right" v-if="auth.user.authenticated">
                        <a href="javascript:void(0)" v-on:click="signout">Sign out</a>
                    </li>
                    <li class="pull-right" v-if="auth.user.authenticated">
                        <router-link :to="{ name: 'profile' }">
                            Hi, {{ auth.user.profile.name }}
                        </router-link>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</template>

<script>
    export default {
        props: ['auth'],
        data() {
           return {
               roles: []
           }
        },
        methods: {
            signout() {
                this.auth.signout()
            }
        },
        mounted() {
            console.log('Navigation mounted.')
        }
    }
</script>