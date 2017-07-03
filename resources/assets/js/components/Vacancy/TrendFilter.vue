<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-8" style="padding-left: 0;">
                <ul class="list-unstyled list-jobs">
                    <li v-for="item in trends" class="list-jobs__item">
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
                trends: {}
            }
        },
        methods: {
            all() {
                this.$http.get('api/vacancy/byTrend/' + this.$route.params.trend).then(response => {

                    // get body data
                    this.trends = response.body;

                }, response => {
                    // error callback
                });
            }
        },
        mounted: function () {
            $("#vacancy_title").html("Vacancies by trend");
            this.all()
        }
    }
</script>