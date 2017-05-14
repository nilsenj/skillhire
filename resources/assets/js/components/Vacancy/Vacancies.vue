<template>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div>Vacancies {{ vacancies.count }}</div>
                <ul id="example-1">
                    <li v-for="item in vacancies.items">
                        <h3 class="text-muted text-capitalize">
                            <router-link :to="{ name: 'vacancy', params: { vacancyId: item.id }}">{{ item.title }}
                            </router-link>
                        </h3>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                vacancies: {}
            }
        },
        methods: {
            all() {
                this.$http.get('api/vacancy/all').then(response => {

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