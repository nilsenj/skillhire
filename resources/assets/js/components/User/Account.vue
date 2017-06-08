<template>
    <div class="container">

        <div class="page-header">

            <h1>My Account</h1>
            <p v-if="visible == 'visible'" style="font-size: 13px;">
                    <b class="text-success">Profile {{visible}}</b>
                    <a   v-on:click="toggleVisibility($event)">(turn off)</a>
                    <a v-if="visible != 'visible'"  v-on:click="toggleVisibility($event)">(turn on)</a>
                    &nbsp;•&nbsp;&nbsp;<a href="/q/67680705/" target="_blank"><i class="icon-hand-right"></i>Смотреть публичный профиль</a>
            </p>
            <p v-if="visible != 'visible'" style="font-size: 13px;">
                    <b class="text-warning">Profile {{visible}}</b>
                    <a   v-on:click="toggleVisibility($event)">(turn on)</a>
                    &nbsp;•&nbsp;&nbsp;<a href="/q/67680705/" target="_blank"><i class="icon-hand-right"></i>Смотреть публичный профиль</a>
            </p>
            <ul class="nav nav-pills" style="margin: 1.5em 0 1em;">
                <router-link tag="li" exact-active-class="active" to="/account/profile">
                    <router-link :to="{ name: 'profile' }">Profile</router-link>
                </router-link>
                <router-link tag="li" exact-active-class="active" to="/account/skills">
                    <router-link :to="{ name: 'skills' }">Skills</router-link>
                </router-link>
                <router-link tag="li" exact-active-class="active" to="/account/contact">
                    <router-link :to="{ name: 'contact' }">Contacts and Resume</router-link>
                </router-link>
                <li><a href="/my/review/">HR-review</a></li>
                <li><a href="/my/subscriptions/">Рассылки</a></li>
                <li><a href="/my/stoplist/">Стоп-лист</a></li>
                <li><a href="/my/kill9/">Удалить профиль</a></li>
            </ul>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    import auth from '../../auth.js';
    import vueSlider from 'vue-slider-component'
    import Multiselect from 'vue-multiselect'

    export default {
        data() {
            return {
                visible: 'visible',
                error: false,
                errorMsg: ''
            }
        },
        methods: {
            getAccountStatus() {
                Vue.http.get(
                    'api/profile/getVisibility',
                    {}
                ).then(response => {
                    this.error = false;
                    this.visible = response.body.visible;
                }, response => {
                    this.error = true;
                    this.errorMsg = response.error;
                })
            },
            toggleVisibility(event) {
                event.preventDefault();
                Vue.http.post(
                    'api/profile/toggleVisibility',
                    {}
                ).then(response => {
                    this.error = false;
                    this.visible = response.body.visible;
                }, response => {
                    this.error = true
                    this.errorMsg = response.error
                })
            }
        },
        mounted: function () {
            this.getAccountStatus();
        },
        components: {
        }
    }
</script>