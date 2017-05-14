<template>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h2 class="text-muted">{{ vacancy.title }}</h2>
                <p class="text-capitalize">
                    {{ vacancy.body }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                vacancy: {}
            }
        },
        methods: {
            show() {
                this.$http.get('api/vacancy/show/' + this.$route.params.vacancyId).then(response => {

                    // get body data
                    this.vacancy = response.body;

                }, response => {
                    // error callback
                });
            }
        },
        mounted: function () {
            this.show()
        }
    }
</script>