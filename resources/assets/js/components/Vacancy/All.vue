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


                        <div class="jobs-filter__set-title">
                            По тексту вакансии

                        </div>
                        <form method="get" id="searchform" class="form">


                            <div class="input-group">

                                <input type="text" id="keywords" name="keywords" class="input form-control"
                                       placeholder="Например: Node.js" value="">
                                <span class="input-group-btn">
                <input type="submit" class="btn btn-default" value="→">
              </span>
                            </div>
                        </form>
                        <br>

                    </div>
                </div>

            </div>
            <div class="col-sm-8 col-sm-pull-4" style="padding-left: 0;">
                <ul class="list-unstyled list-jobs">
                    <li v-for="item in vacancies.items" class="list-jobs__item">
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

                <ul class="pager" style="text-align: left;">
                    <li>

                        <a href="/jobs/?page=2">вперед →</a>

                    </li>
                </ul>


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
        background-color: #f5f8fb;
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
                variants: {}
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
            this.all();
            this.allTrends();
            this.getDistinctLocations();
            this.getVariants();
        }
    }
</script>