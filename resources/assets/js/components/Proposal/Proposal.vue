<template>
    <div class="container">
        <strong>
            <router-link class="btn-link" :to="'proposals/all'">← Go back to proposals</router-link>
        </strong>
        <div class="row">
            <div class="col-sm-7 col-sm-offset-1 col-xs-12 col-sm-push-4">
                <div class="alert alert-danger" v-if="proposal_statuses.status == 'closed'">
                    <p>
                        Proposal closed or not yet accepted
                    </p>
                </div>
                <div class="alert alert-info" v-if="proposal_statuses.status == 'opened'">
                    <p>
                        Proposal opened from both sides
                    </p>
                </div>
                <div v-for="message in proposal.messages" class="thread-message">
                    <div class="clearfix" style="margin-bottom: 0.75em;">
                        <div class="clearfix" style="margin-bottom: 0.75em;">
                            <router-link :to="'account/public-profile/'+message.user.id">
                                <img v-if="message.user.contacts.avatar"
                                     style="float: left; margin-right: 10px; width: 40px; height: 40px;"
                                     class="userpic" :src="message.user.contacts.avatar">
                                <img v-if="!message.user.contacts.avatar"
                                     style="float: left; margin-right: 10px; width: 40px; height: 40px;"
                                     class="userpic" :src="message.user.contacts.default_image">
                            </router-link>
                            <strong>
                                <router-link :to="'account/public-profile/'+message.user.id">
                                    {{ message.user.name }}
                                </router-link>
                            </strong>
                            <br>
                            <small class="text-muted">{{ proposal_statuses.created_at }}</small>
                        </div>
                        <p>
                            {{message.body}}
                        </p>
                    </div>
                </div>
                <br>
                <form v-if="preOpened" method="post"
                      class="form-horizontal form-horizontal-text-left js-inbox-reply-form">
                    <div class="form-group" style="margin-right: 0; margin-left: 0;">
                        <h4 style="margin-top: 0;">Write greetings message</h4>
                        <textarea rows="5" v-model="message" placeholder="optional" name="message"
                                  class="form-control keysubmit js-inbox-reply-message"></textarea>
                    </div>
                </form>
                <a name="reply"></a>
                <form v-if="proposal_statuses.status == 'opened'" method="post"
                      class="form-horizontal form-horizontal-text-left js-inbox-reply-form">
                    <div class="form-group" style="margin-right: 0; margin-left: 0;">
                        <h4 style="margin-top: 0;">Reply</h4>
                        <textarea v-model="newMessage" rows="5" name="message"
                                  class="form-control keysubmit js-inbox-reply-message "></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary js-inbox-send-btn" data-loading-text="Отправляется...">
                        Send
                    </button>
                </form>

                <div v-if="proposal_statuses.status == 'closed'" class="js-inbox-action-btns">
                    <button class="btn btn-primary js-inbox-toggle-reply-form" v-on:click="openProposal">
                        Start Conversation
                    </button>
                    <button class="btn btn-default" data-toggle="modal" data-target="#decline-modal">Decline </button>
                </div>
                <br>
                <hr>
                <p>
                    <small>
                        <!--<a class="xxx" href="/my/inbox/841141/?archive_from_inbox">Отправить переписку в Архив</a> |-->
                        <!--<a href="/my/stop/">Выключить профиль</a>-->
                        <a v-on:click="toggleVisibility($event)">(turn off)</a>
                    </small>
                </p>
                <br>
                <div class="visible-xs-block">
                    <hr>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12 col-sm-pull-8">
                <div class="clearfix">
                    <router-link :to="'account/public-profile/'+proposal.author_id">
                        <img v-if="proposal.author.contacts.avatar"
                             style="float:left; margin-right: 10px;"
                             class="userpic" :src="proposal.author.contacts.avatar">
                        <img v-if="!proposal.author.contacts.avatar"
                             style="float:left; margin-right: 10px;"
                             class="userpic" :src="proposal.author.contacts.default_image">
                    </router-link>
                    <p class="recruiter-name">
                        <router-link :to="'account/public-profile/'+proposal.author_id">{{proposal.author.name}}</router-link>

                    </p>
                    <p class="recruiter-headline">{{proposal.author.profile.position}}</p>

                    <p><a v-if="proposal.author.contacts.skype"
                          :href="'skype:'+proposal.author.contacts.skype">{{proposal.author.contacts.skype}}</a></p>
                    <p><a v-if="proposal.author.contacts.linkedin"
                          :href="proposal.author.contacts.linkedin">LinkedIn</a></p>
                    <p><a v-if="proposal.author.contacts.github"
                          :href="proposal.author.contacts.github">Github</a></p>
                    <p><a v-if="proposal.author.contacts.telegram"
                          :href="'telegram.me/@'+proposal.author.contacts.telegram">Telegram</a></p>
                    <a :href="'mailto:'+proposal.author.contacts.email">{{proposal.author.contacts.email}}</a><br>
                </div>

                <p class="text-muted">
                    Rating:

                    not defined

                    <br>Here since {{proposal.author.created_at}}
                </p>
                <br><br>
                <h5>Rate {{proposal.author.name}}</h5>
                <form method="post" id="rate_recruiter">
                    <star-rating :max-rating="5"
                                 :step="2"
                                 @rating-selected="updateRating($event)"
                                 :increment="1"
                                 :rating="proposal.author_rating.rating" :showRating="false"
                                 :star-size="28"></star-rating>
                    <p>
                        <small>Оценка анонимная.
                            По этим оценкам строится рейтинг работодателя на Джинне.
                        </small>
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>
<style>

</style>
<script>
    import auth from '../../services/auth.service.js';
    import StarRating from 'vue-star-rating'
    export default {
        data() {
            return {
                proposal: {},
                proposal_statuses: {},
                preOpened: false,
                users: {},
                message: "",
                newMessage: "",
                visible: 'visible',
                error: false,
                errorMsg: ''
            }
        },
        props: ['proposals', 'auth'],
        methods: {
            show() {
                let _this = this;
                this.$http.get('api/proposals/' + this.$route.params.proposalId).then(response => {
                    // get body data
                    _this.proposal = response.body.proposal;
                    _this.proposal_statuses = response.body.proposal.proposal_statuses;
                    _this.first_message = response.body.proposal.messages.length > 0 ? response.body.proposal.messages[0] : '';
                    _this.users = response.body.users;
                    let messages = _this.proposal.messages;
                    let messagesArr = [];
                    messages.forEach(function (message, index, arr) {
                        var user = $.grep(_this.users, function (e) {
                            return e.id == message.user_id;
                        });
                        message.user = user.length ? user[0] : {};
                        messagesArr.push(message);
                    });
                    this.proposal.messages = messagesArr;

                    this.preOpened = false;
                }, response => {
                    // error callback
                });
            },
            openProposal(e) {
                e.preventDefault();
                if (this.preOpened) {
                    let data = {
                        status: 'opened',
                        message: this.message
                    };
                    this.$http.post('api/proposals/openProposal/' + this.$route.params.proposalId, data).then(response => {
                        // get body data
                        console.log(response.message);
                        this.show();
                        this.preOpened = false;
                    }, response => {
                        // error callback
                    })
                } else {
                    this.preOpened = true;
                }

            },
            updateRating(event) {
                let counterOld = this.proposal.author_rating.rating;
                if(counterOld != event) {
                    let counter = {};
                    counter.rating = event;
                    this.$http.put('api/proposals/updateRating/'+this.proposal.author_rating.id, counter).then(response => {
                        this.show();
                    }, response => {
                        // error callback
                        this.error = response.data;
                    });
                } else {
                    alert('Nothing changed!');
                }
            },
            __bindUserToMessage(messages, users) {
                console.log(messages, users);
            }
        },
        mounted: function () {
            this.show();
            this.preOpened = false;
            $("#proposal_title").html();
        },
        components: {
            StarRating
        }
    }
</script>