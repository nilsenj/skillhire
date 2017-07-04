<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-push-8">
                <div class="jobs-filter">
                    <div class="jobs-filter-wrapper js-jobs-filter-wrapper">
                        <h2 class="jobs-filter__title">Filters</h2>
                        <div class="jobs-filter__set-title">Trend</div>
                        <div class="jobs-filter__set">
                            <router-link v-for="trend in trends" :key="trend.id"
                                         :to="'/vacancies/trend/'+trend.name" class="jobs-filter__link">
                                {{trend.name}}
                            </router-link>
                        </div>
                        <div class="jobs-filter__set-title">Locations</div>
                        <div class="jobs-filter__set">
                            <router-link v-for="location in locations" :key="location.name"
                                         :to="'/vacancies/location/'+location.name" class="jobs-filter__link">
                                {{location.name}}
                            </router-link>
                        </div>

                        <div class="jobs-filter__set-title">🚜&nbsp;&nbsp;Working variants</div>
                        <div class="jobs-filter__set">
                            <router-link v-for="variant in variants" :key="variant.id"
                                         :to="'/vacancies/variant/'+variant.name" class="jobs-filter__link">
                                {{variant.name}}
                            </router-link>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-8 col-sm-pull-4" style="padding-left: 0;">
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
    body {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
    }

    .list-jobs__title {
        font-size: 18px;
        margin-bottom: 3px;
        text-transform: capitalize;
    }

    .list-jobs__details {
        font-size: 12px;
        color: #999;
    }

    .list-jobs__recruiter-details {
        color: #888;
        /* text-decoration: underline; */
        font-weight: 500;
    }

    .list-jobs__userpic {
        float: left;
        width: 16px;
        height: 16px;
        margin: 1px 5px 0 0;
        border-radius: 50%;
    }

    .list-jobs__item {
        margin-bottom: 24px;
    }

    .jobs-filter__link {
        display: inline-block;
        margin: 0 2px 5px 0;
        padding: 4px 7px 3px;
        background-color: white;
        border-radius: 3px;
    }
</style>
<script>
    import auth from '../../auth.js';
    export default {
        data() {
            return {
                vacancies: {},
                trends: {},
                locations: {},
                variants: {},
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
                var _this = this;
//                $.ajax({
//                    url: 'api/vacancy/all?page='+page,
//                    success: (response) => {
//                        _this.vacancies = response.body;
//                        _this.pagination = response;
//                    }
//                });

                this.$http.get('api/vacancy/all?page='+page).then(response => {

                    // get body data
                    _this.vacancies = response.body.items.data;
                    delete(response.body.items.data);
                    _this.pagination = response.body.items;

                }, response => {
                    // error callback
                });
            },
            allTrends() {
                this.$http.get('api/trends').then(response => {

                    // get body data
                    this.trends = response.body;

                }, response => {
                    // error callback
                });
            },
            getDistinctLocations() {
                this.$http.get('api/vacancy/getDistinctLocations').then(response => {

                    // get body data
                    this.locations = response.body;
                    console.log(response.body);

                }, response => {
                    // error callback
                });
            },
            getVariants() {
                this.$http.get('api/working_variants').then(response => {

                    // get body data
                    this.variants = response.body;

                }, response => {
                    // error callback
                });
            }
        },
        mounted: function () {
            $("#vacancy_title").html("Vacancies");
            let page =  this.$route.query.page ? this.$route.query.page : this.pagination.current_page;
            this.all(page);
            this.allTrends();
            this.getDistinctLocations();
            this.getVariants();
        }
    }
</script>