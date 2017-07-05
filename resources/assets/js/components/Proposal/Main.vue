<template>`
    <div>
        <div class="container">
            <div class="page-header">
                <h1><span id="proposal_title" class="text-capitalize">Proposals</span>
                    <small class="text-muted">{{ proposals.count }}</small>
                </h1>
            </div>
            <router-view></router-view>
        </div>
    </div>
</template>
<style>

</style>
<script>
    import auth from '../../auth.js';
    export default {
        data() {
            return {
                proposals: {}
            }
        },
        methods: {
            all() {
                this.$http.get('api/proposal/byUser').then(response => {
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