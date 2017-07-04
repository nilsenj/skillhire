<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-8" style="padding-left: 0;">
                <ul class="list-unstyled list-jobs">
                    <li v-for="item in vacancies" class="list-jobs__item">
                        <div class="list-jobs__title">
                            <router-link :to="{ name: 'vacancy', params: { vacancyId: item.id }}">{{ item.title }}
                            </router-link>
                        </div>
                        <div class="list-jobs__description">
                            <p>
                                {{ item.body }}
                            </p>
                        </div>
                        <div class="list-jobs__details">
                            <a class="list-jobs__recruiter-details" href="#">
                                <img v-if="item.author.contacts.avatar" class="list-jobs__userpic"
                                     :src="item.author.contacts.avatar"
                                     width="16" height="16" :alt="item.author.name">{{item.author.name}}</a>,
                            {{item.author.profile.position}}
                            ·
                            {{item.location}}
                        </div>
                    </li>
                </ul>
                <vue-simple-pagination v-bind:pagination="pagination"
                                       v-on:click.native="all(pagination.current_page)"
                                       :offset="4">
                </vue-simple-pagination>
            </div>
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
                vacancies: {},
                counter: 0,
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                offset: 4,
            }
        },
        methods: {
            all(page) {
                let _this = this;
                let pager = page ? '?page='+page : '';
                this.$http.get('api/vacancy/byUser'+pager).then(response => {

                    // get body data
                    _this.vacancies = response.data.data;
                    delete(response.data.data);
                    _this.pagination = response.body;

                }, response => {
                    // error callback
                });
            }
        },
        mounted: function () {
            $("#vacancy_title").html("Vacancies by skills");
            let page =  this.$route.query.page ? this.$route.query.page : this.pagination.current_page;
            this.all(page);
        }
    }
</script>