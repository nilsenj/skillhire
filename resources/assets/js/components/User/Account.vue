<template>
    <div class="container">

        <div class="page-header">

            <h1>Мой аккаунт
            </h1>

            <form method="post" action="/my/stop/">

                <p style="font-size: 13px;">

                    <b class="text-success">Профиль активен</b>
                    <a href="/my/stop/">(выключить)</a>


                    &nbsp;•&nbsp;&nbsp;<a href="/q/67680705/" target="_blank"><i class="icon-hand-right"></i>Смотреть публичный профиль</a>
                </p>
                <input type="hidden" name="csrfmiddlewaretoken" value="gBNUl9rekMbAvlUr2QfjQhZqxTrGdTNM">
            </form>
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