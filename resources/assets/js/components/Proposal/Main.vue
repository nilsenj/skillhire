<template>
    <div>
        <div class="container">
            <router-view :proposals="proposals" :auth="auth"></router-view>
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
                proposals: {},
                auth: auth
            }
        },
        methods: {
            all() {
                this.$http.get('api/proposals/all').then(response => {
                    // get body data
                    this.proposals = response.body;
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