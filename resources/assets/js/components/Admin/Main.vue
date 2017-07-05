<template>
    <div>
        <div class="container">
            <div class="page-header">
                <h1><span id="vacancy_title" class="text-capitalize">Admin Panel</span></h1>
                <ul class="nav nav-pills" style="margin: 1.5em 0 1em;">
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
                auth: auth
            }
        },
        methods: {
        },
        mounted: function () {
        }
    }
</script>