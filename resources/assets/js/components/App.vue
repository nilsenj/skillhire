<template>
    <div>
        <navigation :auth="auth"></navigation>
        <router-view :auth="auth"></router-view>
    </div>
</template>

<script>
    import auth from '../auth.js'

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