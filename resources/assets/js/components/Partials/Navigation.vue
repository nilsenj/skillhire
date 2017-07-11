<template>
    <nav class="navbar navbar-default">
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
                        <router-link v-if="auth.user.roles.display_name == 'employer'" :to="{ name: 'employers' }">
                            Employers
                        </router-link>
                    </li>
                    <li>
                        <router-link v-if="auth.user.roles.display_name == 'admin'" :to="{ name: 'admin' }">Admin Page
                        </router-link>
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
                            <span v-if="!auth.user.profile.visible" class="label label-danger">not visible</span>
                            <span v-if="(auth.user.profile.visible) && (auth.user.profile.visible !='visible') && (auth.user.profile.visible !='not visible')"
                                  class="label label-success">online</span>
                            <span v-if="auth.user.profile.visible == 'visible'"
                                  class="label label-success">online</span>
                            <span v-if="auth.user.profile.visible == 'not visible'" class="label label-danger">not visible</span>
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
        created() {
            let _this = this;
            this.eventHub.$on('user:visibility', function (status) {
                _this.auth.user.profile.visible = status.visible;
            });
        },
        methods: {
            signout() {
                this.auth.signout()
            }
        },
        events: {
            'user:visibility': function (data) {
                // do your stuff here
                console.log(data);
            }
        },
        mounted() {
            console.log('Navigation mounted.')
        }
    }
</script>