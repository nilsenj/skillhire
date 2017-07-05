<template>
    <div id="vacancy">
        <div class="row">
            <div class="col-sm-8 col-md-8">
                <p>
                    <a href="/r/9928-ceo-co-founder-at-restream-io/">{{vacancy.author.name}}</a>
                    <span class="status-verified" data-toggle="tooltip" title=""
                          data-original-title="Approved Employee. There are approved hires here!">
                        <span class="icon-verified"></span>
                    </span>
                </p>
                <p>
                    Postion: <span v-if="vacancy.author.profile.position">{{vacancy.author.profile.position}}</span>
                    <span class="text-muted" v-if="!vacancy.author.profile.position">No position provided</span>
                </p>
                <p>
<span class="text-left">
                        Location:
                    </span>
                    <strong style="text-align: right">
                        {{vacancy.location}}
                    </strong>
                </p>
                <p class="text-capitalize">
                    {{ vacancy.body }}
                </p>

                <div class="media">
                    <div class="media-left">
                        <img v-if="vacancy.author.contacts.avatar" class="media-object userpic"
                             :src="vacancy.author.contacts.avatar">
                        <img v-if="!vacancy.author.contacts.avatar" class="media-object userpic"
                             :src="vacancy.author.contacts.default_image">
                    </div>
                    <div class="media-body">
                        <p class="recruiter-name">
                            <a href="#">{{vacancy.author.name}}</a><span
                                class="status-verified" data-toggle="tooltip" title=""
                                data-original-title="Approved Employee. There are approved hires here!">
                     <span class="icon-verified"></span>
                   </span>
                        </p>
                        <p class="headline"> Postion: <span
                                v-if="vacancy.author.profile.position">{{vacancy.author.profile.position}}</span>
                            <span class="text-muted" v-if="!vacancy.author.profile.position">No position provided</span>
                        </p>
                    </div>
                </div>
                <div class="profile-page-section text-small">
                    <p class="text-muted">
                        Vacancy Published
                        <span>{{vacancy.formatted_published}}</span>.
                    </p>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="js-inbox-action-btns">
                            <a name="reply"></a>
                            <form method="post" id="createProposal" class="js-inbox-reply-form">
                                <h3 id="myModalLabel">Reply on vacancy</h3>

                                <div class="form-group">
                                    <textarea class="form-control" v-model="message" id="message" name="message"
                                              rows="6"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" v-on:click="storeProposal" name="job_apply"
                                            data-loading-text="Contact Employee...">
                                        Open Contacts And start communication
                                    </button>
                                </div>
                                <div class="form-group">
                                    <p class="help-block">What contacts employee  will see?
                                        <router-link to="/account/profile/">Set it in account settings</router-link>
                                        .
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</template>
<style>
    #vacancy li {
        list-style-type: none;
    }

    #vacancy .userpic {
        border-radius: 2px;
        width: 50px;
        height: 50px;
        max-width: none;
    }
</style>
<script>
    import auth from '../../services/auth.service.js';
    export default {
        data() {
            return {
                vacancy: {},
                vacancy_reply: {},
                username: "",
                message: ""
            }
        },
        props: ['auth'],
        methods: {
            show() {
                this.$http.get('api/vacancy/show/' + this.$route.params.vacancyId).then(response => {
                    // get body data
                    this.vacancy = response.body;
                    $("#vacancy_title").html(this.vacancy.title);
                    this.message = 'Hello, ' + this.vacancy.author.name + '. I\'m very interested in your vacancy "' + this.vacancy.title + '". So let\'s talk. ' + this.auth.user.profile.name + '';
                }, response => {
                    // error callback
                    $("#vacancy_title").html(this.vacancy.title);
                });
            },
            storeProposal(e) {
                e.preventDefault();
                let data = {
                    subject: this.vacancy.title,
                    message: this.message,
                    recipients: [this.vacancy.author.id]
                };
                this.$http.post('api/proposals/store', data).then(response => {
                    console.log(response);
                }, response => {
                    console.error(response);
                    // error callback
                    $("#vacancy_title").html(this.vacancy.title);
                });
            },
        },
        mounted: function () {
            this.show();
        }
    }
</script>