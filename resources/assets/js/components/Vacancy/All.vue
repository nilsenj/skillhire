<template>
    <div class="container">
        <div class="row">
                <div class="col-sm-4 col-sm-push-8">
                    <div class="jobs-filter">
                        <a class="jobs-toggle-filters js-jobs-show-filters" href="#">Показать фильтры</a>
                        <a class="jobs-toggle-filters jobs-hide-filters js-jobs-hide-filters" href="#" style="display: none;">Скрыть фильтры</a>
                        <div class="jobs-filter-wrapper js-jobs-filter-wrapper">
                            <h2 class="jobs-filter__title">Фильтры</h2>



                            <div class="jobs-filter__set-title">Специализация</div>
                            <div class="jobs-filter__set">

                                <a href="/jobs/?primary_keyword=JavaScript" class="jobs-filter__link">Front-end (JS)</a>


                                <a href="/jobs/?primary_keyword=PHP" class="jobs-filter__link">PHP</a>


                                <a href="/jobs/?primary_keyword=Java" class="jobs-filter__link">Java</a>


                                <a href="/jobs/?primary_keyword=.NET" class="jobs-filter__link">.NET</a>


                                <a href="/jobs/?primary_keyword=C%2B%2B" class="jobs-filter__link">C / C++</a>


                                <a href="/jobs/?primary_keyword=Python" class="jobs-filter__link">Python</a>


                                <a href="/jobs/?primary_keyword=Ruby" class="jobs-filter__link">Ruby / Rails</a>


                                <a href="/jobs/?primary_keyword=iOS" class="jobs-filter__link">iOS</a>


                                <a href="/jobs/?primary_keyword=Android" class="jobs-filter__link">Android</a>


                                <a href="/jobs/?primary_keyword=QA" class="jobs-filter__link">QA</a>


                                <a href="/jobs/?primary_keyword=Project+Manager" class="jobs-filter__link">Project Manager (PM)</a>


                                <a href="/jobs/?primary_keyword=Sysadmin" class="jobs-filter__link">DevOps / Sysadmin</a>


                                <a href="/jobs/?primary_keyword=Lead" class="jobs-filter__link">Lead</a>


                                <a href="/jobs/?primary_keyword=Design" class="jobs-filter__link">UX / Design</a>


                                <a href="/jobs/?primary_keyword=Marketing" class="jobs-filter__link">Маркетинг и продажи</a>


                                <a href="/jobs/?primary_keyword=HR" class="jobs-filter__link">Рекрутеры и HR</a>


                                <a href="/jobs/?primary_keyword=Product+Manager" class="jobs-filter__link">Product Manager</a>


                                <a href="/jobs/?primary_keyword=Business+Analyst" class="jobs-filter__link">Бизнес-аналитики (BA)</a>


                                <a href="/jobs/?primary_keyword=SQL" class="jobs-filter__link">DBA</a>


                                <a href="/jobs/?primary_keyword=Unity" class="jobs-filter__link">Unity / ActionScript</a>


                                <a href="/jobs/?primary_keyword=Embedded" class="jobs-filter__link">Embedded</a>


                                <a href="/jobs/?primary_keyword=Other" class="jobs-filter__link">(Другие)</a>


                            </div>



                            <div class="jobs-filter__set-title">Город</div>
                            <div class="jobs-filter__set">


                                <a href="/jobs/?location=%D0%9A%D0%B8%D0%B5%D0%B2" class="jobs-filter__link">Киев</a>


                                <a href="/jobs/?location=%D0%A5%D0%B0%D1%80%D1%8C%D0%BA%D0%BE%D0%B2" class="jobs-filter__link">Харьков</a>


                                <a href="/jobs/?location=%D0%9B%D1%8C%D0%B2%D0%BE%D0%B2" class="jobs-filter__link">Львов</a>


                                <a href="/jobs/?location=%D0%94%D0%BD%D0%B5%D0%BF%D1%80%D0%BE%D0%BF%D0%B5%D1%82%D1%80%D0%BE%D0%B2%D1%81%D0%BA" class="jobs-filter__link">Днепр</a>


                                <a href="/jobs/?location=%D0%9E%D0%B4%D0%B5%D1%81%D1%81%D0%B0" class="jobs-filter__link">Одесса</a>


                                <a href="/jobs/?location=%D0%92%D0%B8%D0%BD%D0%BD%D0%B8%D1%86%D0%B0" class="jobs-filter__link">Винница</a>



                                <a href="/jobs/?location=other" class="jobs-filter__link">(Другой город)</a>


                                <a href="/jobs/?location=remote" class="jobs-filter__link">Удаленная работа</a>

                            </div>





                            <div class="jobs-filter__set-title">Для начинающих</div>
                            <div class="jobs-filter__set">

                                <a href="/jobs/?exp_level=junior" class="jobs-filter__link">Junior</a>


                                <a href="/jobs/?exp_level=intern" class="jobs-filter__link">Intern</a>


                                <a href="/jobs/?exp_level=no_exp" class="jobs-filter__link">Без опыта работы</a>

                            </div>

                            <div class="jobs-filter__set-title">🚜&nbsp;&nbsp;Трактор</div>
                            <div class="jobs-filter__set">

                                <a href="/jobs/?location=relocate" class="jobs-filter__link">Предложения на релокейт</a>

                            </div>



                            <div class="jobs-filter__set-title">
                                По тексту вакансии

                            </div>
                            <form method="get" id="searchform" class="form">


                                <div class="input-group">

                                    <input type="text" id="keywords" name="keywords" class="input form-control" placeholder="Например: Node.js" value="">
                                    <span class="input-group-btn">
                <input type="submit" class="btn btn-default" value="→">
              </span>
                                </div>
                            </form>
                            <br>

                        </div>
                    </div>

                </div>
                <div class="col-sm-8 col-sm-pull-4"  style="padding-left: 0;">
                    <ul class="list-unstyled list-jobs">
                        <li v-for="item in vacancies.items" class="list-jobs__item">
                            <div class="list-jobs__title">
                                <router-link :to="{ name: 'vacancy', params: { vacancyId: item.id }}">{{ item.title }}</router-link>
                            </div>
                            <div class="list-jobs__description">
                                <p>
                                    {{ item.body }}
                                </p>
                            </div>
                            <div class="list-jobs__details">
                                <a class="list-jobs__recruiter-details" href="#">
                                    <img v-if="item.author.contacts.avatar" class="list-jobs__userpic" :src="item.author.contacts.avatar"
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
                <ul id="example-1">
                </ul>
        </div>
    </div>
</template>
<style>
    body {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
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
</style>
<script>
    import auth from '../../auth.js';
    export default {
        data() {
            return {
                vacancies: {}
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
            }
        },
        mounted: function () {
            $("#vacancy_title").html("Vacancies");
            this.all()
        }
    }
</script>