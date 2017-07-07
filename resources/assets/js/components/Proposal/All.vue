<template>
    <div class="container">
        <div v-if="error" class="text-warning">
            {{error}}
        </div>
        <h3>
            Proposals
        </h3>
        <div v-for="item in proposals" class="row inbox-message candidate-inbox clearfix ">
            <div class="media col-sm-4">
                <div class="media-left">
                    <img v-if="item.author.contacts.avatar" class="media-object userpic"
                         :src="item.author.contacts.avatar">
                    <img v-if="!item.author.contacts.avatar" class="media-object userpic"
                         :src="item.author.contacts.default_image">
                </div>
                <div class="media-body">
                    <p class="recruiter-name">
                        <router-link :to="'account/public-profile/'+item.author.id">{{item.author.name}}</router-link>
                    </p>
                    <p class="headline">{{item.author.profile.position}}</p>
                    <p class="inbox-date">
                        {{item.inbox_date}}
                    </p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="message-text">
                    <router-link  :to="{ name: 'proposal', params: { proposalId: item.id }}">
                        <div v-if="item.latest_message.user_id == auth.user.profile.id">
                            <span class="message-your-reply">You: </span> {{item.latest_message.body}}
                        </div>
                    </router-link>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="message-btn-wrapper">
                    <div class="btn-group">
                        <button class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-click="dropdown">
                            Ответить <b class="caret"></b>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="/my/inbox/841141/#reply">Начать общение</a></li>





                            <li><a href="/my/inbox/841141/?archive_from_inbox=">Отправить в архив</a></li>

                            <li class="divider"></li>
                            <li><a href="/my/stop/">Я уже не ищу работу</a></li>

                            <li><a href="/my/report_hire/?pk=25196&amp;from=inbox">Сообщить о найме</a></li>

                        </ul>
                    </div>
                </div>
            </div>
            </div></div>
</template>
<style>
    body {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
    }

    .inbox-message:hover {
        background-color: #faf8f5;
    }
    .candidate-name, .recruiter-name {
        font-weight: bold;
        line-height: 1.3;
        margin-bottom: 0.33em;
    }
    .headline, .recruiter-headline {
        color: #7d8e8b;
        font-size: 0.9em;
        margin: 0 0 0.25em;
        line-height: 1.3;
        overflow: hidden;
    }
    .inbox-date {
        line-height: 1.3;
        color: #999;
        margin: 0;
        font-size: 0.8em;
    }
    .message-text {
        margin-bottom: 1em;
        overflow: hidden;
    }
    .message-your-reply {
        font-weight: bold;
        color: #888;
        padding-left: 12px;
        display: inline-block;
        position: relative;
    }
    .message-btn-wrapper {
        text-align: right;
    }
    .userpic {
        border-radius: 2px;
        width: 50px;
        height: 50px;
        max-width: none;
    }
    .inbox-message, .recruiter-row {
        border-bottom: 1px solid #e5e5e5;
        padding: 15px 0;
        margin-top: 0;
        position: relative;
    }
</style>
<script>
    import auth from '../../services/auth.service.js';
    export default {
        data() {
            return {
                error: ""
            }
        },
        props: ['proposals', 'auth'],
        methods: {
            all() {
            }
        },
        mounted: function () {
            $("#proposal_title").html("Proposals");
        }
    }
</script>