<template>
    <div class="container">
        <h1>
            Proposal
        </h1>
    </div>
</template>
<style>
</style>
<script>
    import auth from '../../services/auth.service.js';
    export default {
        data() {
            return {
                proposal: {},
                error: ""
            }
        },
        props: ['proposals', 'auth'],
        methods: {
            show() {
                this.$http.get('api/proposals/' + this.$route.params.proposalId).then(response => {
                    // get body data
                    this.proposal = response.body;
                }, response => {
                    // error callback
                });
            }
        },
        mounted: function () {
            this.show();
            $("#proposal_title").html();
        }
    }
</script>