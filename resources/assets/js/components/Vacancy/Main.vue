<template>
    <div>
        <div class="container">
            <div class="page-header">
                <h1><span id="vacancy_title" class="text-capitalize">Vacancies</span>
                    <small class="text-muted">{{ vacancies.count }}</small>
                </h1>
                <ul class="nav nav-pills" style="margin: 1.5em 0 1em;">
                    <router-link tag="li" exact-active-class="active" to="/vacancies/all">
                        <router-link :to="{ name: 'all' }">All</router-link>
                    </router-link>
                    <router-link tag="li" exact-active-class="active" to="/vacancies/bymyprofile">
                        <router-link :to="{ name: 'bymyprofile' }">By My Profile</router-link>
                    </router-link>

                </ul>
            </div>
            <router-view :auth="auth"></router-view>
        </div>
    </div>
</template>
<style>

</style>
<script>
    import auth from '../../services/auth.service.js';
    export default {
        data() {
            return {
                vacancies: {},
                auth: auth
            }
        },
        methods: {
            all() {
                this.$http.get('api/vacancy/byUser').then(response => {

                    // get body data
                    this.vacancies = response.body;

                }, response => {
                    // error callback
                });
            }
        },
        mounted: function () {
            this.all()
        }
    }
</script>