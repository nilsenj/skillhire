<template>
    <div>
        <navigation :auth="auth"></navigation>
        <router-view :auth="auth"></router-view>
    </div>
</template>
<script>
    import auth from '../services/auth.service.js'

    export default {
        data() {
            return {
                auth: auth
            }
        },
        methods: {
        },
        mounted: function () {
            this.$nextTick(function () {
                auth.check()
            })
        }
    }
</script>