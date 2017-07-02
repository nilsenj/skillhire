<template>
    <div class="container">
    </div>
</template>
<style>

</style>
<script>
    import auth from '../../auth.js';
    export default {
        data() {
            return {
                vacancies: {}
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
            $("#vacancy_title").html("Vacancies by skills");
            this.all()
        }
    }
</script>