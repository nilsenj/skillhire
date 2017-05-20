<template>
    <form method="post" v-on:submit="updateProfile" class="js-profile-form form-horizontal form-horizontal-text-left">
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="position">Position</label>
                    <div class="col-sm-7">
                        <input type="text" name="position" autocomplete="off" data-provide="typeahead" id="position"
                               class="form-control"  v-model="profile.position" placeholder="Senior PHP Developer">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="salary">Salary not lower than</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="number" name="salary" id="salary" step="100" min="100"
                                   required="required" v-model="profile.salary" autocomplete="off" class="form-control input salary"
                                   placeholder="500">
                        </div>
                        <p class="help-block">Если не уверены сколько написать, посмотрите
                            <a target="_blank"
                               href="https://djinni.co/salaries/?city=Львов&amp;job=PHP&amp;year=6m">наш виджет зарплат</a>
                            и
                            <a target="_blank"
                               href="/search/?sortby=rating&amp;keywords=PHP">как оценивают себя другие</a>.
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="location">City/Location</label>
                    <div class="col-sm-7">
                        <input type="text" name="location" id="location" autocomplete="off" data-provide="typeahead"
                               required="required" v-model="profile.location" class="form-control input location" placeholder="Kiev, Lviv, Odessa, Kharkiv">
                        <p class="help-block">Город, где вы ищете работу.
                            Например: Киев, Львов.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="moreinfo">
                        Experience
                    </label>
                    <div class="col-sm-7">
              <textarea rows="9" class="form-control" maxlength="750" name="moreinfo" id="moreinfo" placeholder="Php, Laravel, Angular2, Vue.js, Node.js, Express.js,
MySQL, Redis, MongoDB,
JavaScript, Linux, CSS, HTML, Backbone, React." v-model="profile.experience"></textarea>
                        <p class="help-block">Напишите главное, не пишите все
                            знакомые аббревиатуры.</p>
                        <p class="charsLeft-warn moreinfo-charsLeft-warn text-warning" style="display:none;">
                            <span class="charsLeftHelp">Осталось символов:</span>
                            <span class="charsLeft moreinfo-charsLeft label label-danger">750</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group">
                    <h4 class="col-sm-offset-3 col-sm-7" style="margin-bottom: 0;">Additional Info </h4>
                </div>
                <div id="extraquestions">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Experience</label>
                        <div class="col-sm-7" style="z-index: 0;">
                            <vue-slider ref="slider" :height="8"
                                        :dotSize="20" :tooltip="true" :disabled="false" :piecewise="true"
                            :piecewiseLabel="true" :real-time="true" :min="0" :max="15" :interval="1" v-model="profile.experience_time"></vue-slider>
                            <p class="help-block experience-slider-value" style="color: inherit;">{{profile.experience_time}} years</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Main trend</label>
                        <div class="col-sm-6">
                            <!--<select class="form-control" id="main_trend" name="main">-->
                                <!--<option value=""></option>-->
                                <!--<option v-for="item in profile.trend_options" :value="item.name">{{item.name}}</option>-->
                            <!--</select>-->
                            <multiselect v-model="profile.main_trend" name="main_trend" id="main_trend" @tag="addMainTrend" :taggable="true" label="name"
                                         track-by="name" placeholder="Type to search" :options="profile.trend_options" :multiple="false"
                                         :searchable="true" :loading="false" :clear-on-select="true"
                                         :close-on-select="true" :options-limit="300" :limit="50">
                                <span slot="noResult">Oops! No skills found. Consider changing the search query.</span>
                            </multiselect>
                            <p class="help-block">
                                Чтобы работодателю легче было найти вас в <a href="/developers/">поиске</a>
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Secondary trend</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="second_trend" name="second_trend">
                                <option value=""></option>
                                <option v-for="item in profile.trend_options" :value="item.name">{{item.name}}</option>
                            </select>
                            <p class="help-block">
                                Для особых случаев, например .NET + Lead.
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Уровень английского языка</label>

                        <div class="col-sm-7">

                            <div class="radio">
                                <label>
                                    <input type="radio" name="english_level" value="no english">
                                    Нет английского
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" name="english_level" value="basic">
                                    Слабый английский (Pre-Intermediate)
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" name="english_level" value="intermediate">
                                    На уровне чтения тех. документации (Intermediate)
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" name="english_level" value="good enough">
                                    Пишу и говорю, хоть и с ошибками (Upper Intermediate)
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" name="english_level" value="fluent" checked="checked">
                                    Свободный английский (Advanced/Fluent)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="col-sm-3 control-label">
                            Варианты

                        </label>

                        <div class="col-sm-7">


                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="employment_options" value="fulltime">
                                    Работа на полный день в офисе
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="employment_options" value="remote"
                                           checked="checked">
                                    Удаленная работа (полный день)
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="employment_options" value="freelance"
                                           checked="checked">
                                    Фриланс (разовые проекты)
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="employment_options" value="move">
                                    Переезд в другой город
                                    Украины

                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="employment_options" value="relocate">
                                    Relocate в США или Европу (<a target="_blank"
                                                                  href="http://lurkmore.to/%D0%9F%D0%BE%D1%80%D0%BE%D1%81%D1%91%D0%BD%D0%BE%D0%BA_%D0%9F%D1%91%D1%82%D1%80#.D0.A1.D1.80.D0.B0.D0.BD.D1.8B.D0.B9_.D1.82.D1.80.D0.B0.D0.BA.D1.82.D0.BE.D1.80">трактор</a>)
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <h4 class="col-sm-offset-3 col-sm-7">Ищете что-то особенное?</h4>


                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="looking_for">Ожидания от работы</label>

                        <div class="col-sm-7">
                <textarea rows="5" class="input form-control" maxlength="750" name="looking_for" id="looking_for">team work/project required.
nice team and real challenge.
project architecture,
refactoring,
business logic improvements,
optimization.</textarea>

                            <p class="help-block">Если знаете, чем точно НЕ хотите
                                заниматься, напишите и об этом.</p>

                            <p class="charsLeft-warn looking_for-charsLeft-warn text-warning" style="display:none;">
                                <span class="charsLeftHelp">Осталось символов:</span>
                                <span class="charsLeft looking_for-charsLeft label label-danger">750</span>
                            </p>
                        </div>
                    </div>

                    <br>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="highlights">Достижения</label>
                        <div class="col-sm-7">
                <textarea rows="5" class="input form-control" maxlength="750" name="highlights" id="highlights">E-commerce,
Payment system implementation,
CRM development,
Security features,
Microservices architecture,
Modular architecture,
Email delivery systems.
Code quality improvements,
refactoring,
Arhitecture and Code structure design.
Mentoring teams/projects.
linkedin: https://ua.linkedin.com/in/ivan-nikolenko-913096a9</textarea>

                            <p class="help-block">Чем конкретнее, тем лучше. Для
                                интересных предложений must have.</p>

                            <p class="charsLeft-warn highlights-charsLeft-warn text-warning" style="display:none;">
                                <span class="charsLeftHelp">Осталось символов:</span>
                                <span class="charsLeft highlights-charsLeft label label-danger">750</span>
                            </p>
                        </div>
                    </div>
                    <br>
                </div>

            </div>


        </div>


        <div class="row">
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                        <input type="hidden" name="csrfmiddlewaretoken" value="gBNUl9rekMbAvlUr2QfjQhZqxTrGdTNM">
                        <input type="submit" class="btn btn-primary btn-lg form_btn" value="Обновить мой профиль
                ">

                    </div>
                </div>

                <br>

                <div class="form-group">

                    <div class="col-sm-offset-3 col-sm-7 help-block">
                        <h5>ПОДСКАЗКИ ДЖИННА</h5>
                        <ol>
                            <li>Хотите интересных предложений? Заинтересуйте.
                                Лучшие работодатели
                                переборчивы в контактах и не реагируют на
                                «шаблонные» профили.
                            </li>
                            <li>Если вы джуниор, обязательно опишите свой опыт работы. Пусть даже
                                это учебный или тестовый проект.
                            </li>
                            <li>Примеры хорошо заполненых профилей <a
                                    href="/developers/?sortby=rating">смотрите здесь</a>.
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

    </form>
</template>

<script>
    import vueSlider from 'vue-slider-component'
    import Multiselect from 'vue-multiselect'

    export default {
        data() {
            return {
                profile: {
                    experience_time:null,
                    id: null,
                    created_at:"",
                    description:"",
                    experience:"",
                    expectations:"",
                    achievement:"",
                    english_skill:"",
                    job_variants:"",
                    location:"",
                    main_trend: null,
                    position:"",
                    salary:"0.00",
                    second_trend:"",
                    updated_at:"",
                    user_id: null,
                    trend_options: []
                },
                error: false,
                errorMsg: ''
            }
        },
        methods: {
            showProfile() {
                Vue.http.get(
                    'api/profile/show'
                ).then(response => {
                    this.error = false;
                    this.profile = response.data;
                }, response => {
                    this.error = true
                    this.errorMsg = response.error
                })
            },
            updateProfile(event) {
                event.preventDefault();
            },
            addMainTrend: function (val) {
             return this.profile.main_trend = val;
            }
        },
        mounted: function () {
            this.showProfile();
        },
        components: {
            vueSlider,
            Multiselect
        }
    }
</script>