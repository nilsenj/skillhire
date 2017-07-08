<template>
    <div class="container">
        <strong>
            <router-link class="btn-link" :to="'proposals/all'">← Go back to proposals</router-link>
        </strong>
        <div class="row">
            <div class="col-sm-7 col-sm-offset-1 col-xs-12 col-sm-push-4">
                <div class="thread-message">
                    <div class="clearfix" style="margin-bottom: 0.75em;">
                        <div class="alert alert-info" v-if="proposal.proposal_statuses.status == 'opened'"></div>
                        <small class="text-muted">{{proposal.proposal_statuses.created_at}}</small>
                    </div>
                    <p>
                        {{__first(proposal.messages).body}}
                    </p>
                </div>
                <br>
                <a name="reply"></a>
                <form v-if="proposal.proposal_statuses.status == 'opened'" method="post"
                      class="form-horizontal form-horizontal-text-left js-inbox-reply-form">
                    <div class="form-group" style="margin-right: 0; margin-left: 0;">
                        <h4 style="margin-top: 0;">Reply</h4>
                        <textarea rows="5" name="message"
                                  class="form-control keysubmit js-inbox-reply-message "></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary js-inbox-send-btn" data-loading-text="Отправляется...">
                        Отправить
                    </button>
                    <input type="hidden" name="csrfmiddlewaretoken" value="DriTYJaDUpffWaOjAsItJopwQL4E1oFz">
                </form>

                <div v-if="proposal.proposal_statuses.status == 'closed'" class="js-inbox-action-btns">
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
                    <a href="/r/25196-product-owner-at-technologyideas-com/"><img class="userpic"
                                                                                  style="float:left; margin-right: 10px;"
                                                                                  src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/2/000/04e/1fc/08759bc.jpg"></a>
                    <p class="recruiter-name"><a
                            href="/r/25196-product-owner-at-technologyideas-com/">Bogdan Yatsina</a>

                    </p>
                    <p class="recruiter-headline">Product Owner at technologyideas.com</p>

                    <p><a href="https://www.linkedin.com/in/bogdanyatsyna/">LinkedIn</a></p>


                    Skype: yatsinaba<br>
                    <a href="mailto:leritomi@gmail.com">leritomi@gmail.com</a><br>

                    <p></p>
                </div>

                <p class="text-muted">
                    Рейтинг:

                    н/д

                    <br>На Джинне с июля 2017
                </p>


                <p class="text-muted">
                    <small>Последний поиск:
                        PHP программисты
                        <nobr>
                            Июль 4, 2017
                        </nobr>
                        .
                    </small>
                </p>


                <p><a href="/my/report_hire/?pk=25196&amp;from=inbox_thread">Сообщить о найме</a></p>


                <small>
                    <a href="#spam" role="button" data-toggle="modal" style="color: #b7b7b7"><i
                            class="glyphicon glyphicon-exclamation-sign"></i> Пожаловаться на
                        работодателя</a></small>


                <div id="spam" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true" data-swiftype-index="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Пожаловаться на Bogdan Yatsina</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="text-warning">Три таких жалобы и рекрутер исчезает с Джинна.</p>
                                    <label class="control-label" for="decline_message"><strong>Напишите почему, чтобы у рекрутера
                                        был шанс исправиться:</strong></label>
                                    <textarea id="decline_message" name="comment" rows="3"
                                              class="input form-control keysubmit" required=""></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                                        Не жаловаться
                                    </button>
                                    <input type="submit" class="btn btn-danger" name="flagged" value="Пожаловаться">
                                </div>
                                <input type="hidden" name="csrfmiddlewaretoken"
                                       value="DriTYJaDUpffWaOjAsItJopwQL4E1oFz">
                            </form>
                        </div>
                    </div>
                </div>


                <br><br>
                <h5>Оцените Bogdan Yatsina</h5>
                <form method="post" id="rate_recruiter">
                    <input type="range" min="0" max="5" step="1" value="0" name="rate25196" id="rate25196"
                           style="display: none;">
                    <div class="rateit bigstars" id="rateit" data-rateit-min="0" data-rateit-max="5"
                         data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-resetable="false"
                         data-rateit-backingfld="#rate25196">
                        <button id="rateit-reset-2" class="rateit-reset" aria-label="reset rating"
                                aria-controls="rateit-range-2" style="display: none;"></button>
                        <div id="rateit-range-2" class="rateit-range" tabindex="0" role="slider" aria-label="rating"
                             aria-owns="rateit-reset-2" aria-valuemin="0" aria-valuemax="5" aria-valuenow="0"
                             aria-readonly="false" style="width: 160px; height: 32px;">
                            <div class="rateit-selected" style="height: 32px; width: 0px; display: block;"></div>
                            <div class="rateit-hover" style="height: 32px; width: 0px; display: none;"></div>
                        </div>
                    </div>

                    <p>
                        <small>Оценка анонимная.
                            По этим оценкам строится рейтинг работодателя на Джинне.
                        </small>
                    </p>

                    <input type="hidden" name="rateit">
                    <input type="hidden" name="csrfmiddlewaretoken" value="DriTYJaDUpffWaOjAsItJopwQL4E1oFz">
                </form>


            </div>
        </div>
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
                users: {},
                visible: 'visible',
                error: false,
                errorMsg: ''
            }
        },
        props: ['proposals', 'auth'],
        methods: {
            show() {
                this.$http.get('api/proposals/' + this.$route.params.proposalId).then(response => {
                    // get body data
                    this.proposal = response.body.proposal;
                    this.users = response.body.users;
                }, response => {
                    // error callback
                });
            },
            openProposal(e) {
                let data = {
                    status: 'opened'
                };

                this.$http.post('api/proposals/' + this.$route.params.proposalId, data).then(response => {
                    // get body data
                    console.log(response.message);
                    this.show();
                }, response => {
                    // error callback
                })
            },
            __first(messages) {
                return messages.length > 0 ? messages[0] : ''
            }
        },
        mounted: function () {
            this.show();
            $("#proposal_title").html();
        }
    }
</script>