<template>
    <form method="post" class="js-profile-form form-horizontal form-horizontal-text-left">
        <div class="row">
            <div class="col-sm-10">

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="position">Должность</label>
                    <div class="col-sm-7">
                        <input type="text" name="position" autocomplete="off" data-provide="typeahead" id="position"
                               class="form-control" value="Senior PHP Developer">
                    </div>
                </div>


                <div class="form-group">

                    <label class="col-sm-3 control-label" for="salary_min">Зарплата не ниже</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="number" name="salary_min" id="salary_min" step="100" min="100"
                                   required="required" autocomplete="off" class="form-control input salary"
                                   value="3500">

                        </div>
                        <p class="help-block">Если не уверены сколько написать, посмотрите
                            <a target="_blank"
                               href="https://djinni.co/salaries/?city=Львов&amp;job=PHP&amp;year=6m">наш виджет зарплат</a>
                            и
                            <a target="_blank" href="/search/?sortby=rating&amp;keywords=PHP">как оценивают себя другие</a>.
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="location">Город</label>
                    <div class="col-sm-7">
                        <input type="text" name="location" id="location" autocomplete="off" data-provide="typeahead"
                               required="required" class="form-control" value="Kiev, Lviv, Odessa, Kharkiv">
                        <p class="help-block">Город, где вы ищете работу.
                            Например: Киев, Львов.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="moreinfo">
                        Опыт, навыки

                    </label>

                    <div class="col-sm-7">
              <textarea rows="9" class="form-control" maxlength="750" name="moreinfo" id="moreinfo">Php, Laravel, Angular2, Vue.js, Node.js, Express.js,
MySQL, Redis, MongoDB,
JavaScript, Linux, CSS, HTML, Backbone, React.</textarea>

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
                    <h4 class="col-sm-offset-3 col-sm-7" style="margin-bottom: 0;">Дополнительная информация </h4>
                </div>

                <div id="extraquestions">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Опыт работы</label>

                        <div class="col-sm-7">

                            <div class="experience-slider noUi-target noUi-ltr noUi-horizontal noUi-background">
                                <div class="noUi-base">
                                    <div class="noUi-origin noUi-stacking" style="left: 64.2857%;">
                                        <div class="noUi-handle noUi-handle-lower"></div>
                                    </div>
                                </div>
                                <div class="noUi-pips noUi-pips-horizontal">
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-large"
                                         style="left: 0.00000%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-large"
                                         style="left: 0.00000%">0
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 7.14286%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 7.14286%">1
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 14.28571%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 14.28571%">2
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 21.42857%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 21.42857%">3
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 28.57143%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 28.57143%">4
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 35.71429%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 35.71429%">5
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 42.85714%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 42.85714%">6
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 50.00000%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 50.00000%">7
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 57.14286%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 57.14286%">8
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 64.28571%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 64.28571%">9
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 71.42857%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 71.42857%">10
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 78.57143%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 78.57143%">11
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 85.71429%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 85.71429%">12
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-sub"
                                         style="left: 92.85714%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-sub"
                                         style="left: 92.85714%">13
                                    </div>
                                    <div class="noUi-marker noUi-marker-horizontal noUi-marker-large"
                                         style="left: 100.00000%"></div>
                                    <div class="noUi-value noUi-value-horizontal noUi-value-large"
                                         style="left: 100.00000%">14
                                    </div>
                                </div>
                            </div>
                            <p class="help-block experience-slider-value" style="color: inherit;">6 лет</p>
                            <input class="experience-slider-input" name="experience_years" type="hidden"
                                   value="9.00">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Категория</label>

                        <div class="col-sm-6">
                            <select class="form-control" id="id_primary_keyword_cache" name="primary_keyword_cache">
                                <option value="JavaScript">JavaScript</option>
                                <option value="Java">Java</option>
                                <option value=".NET">.NET</option>
                                <option value="iOS">iOS</option>
                                <option value="Android">Android</option>
                                <option value="Lead">Lead</option>
                                <option value="Design">Design</option>
                                <option value="PHP" selected="selected">PHP</option>
                                <option value="Python">Python</option>
                                <option value="Ruby">Ruby</option>
                                <option value="C++">C++</option>
                                <option value="Unity">Unity</option>
                                <option value="QA">QA</option>
                                <option value="SQL">SQL</option>
                                <option value="Sysadmin">Sysadmin</option>
                                <option value="Embedded">Embedded</option>
                                <option value="Project Manager">Project Manager</option>
                                <option value="Product Manager">Product Manager</option>
                                <option value="Business Analyst">Business Analyst</option>
                                <option value="HR">HR</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Other">Other</option>
                            </select>
                            <p class="help-block">
                                Чтобы работодателю легче было найти вас в <a href="/developers/">поиске</a>
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Дополнительная категория</label>

                        <div class="col-sm-6">
                            <select class="form-control" id="id_secondary_keyword" name="secondary_keyword">
                                <option value=""></option>
                                <option value="JavaScript" selected="selected">JavaScript</option>
                                <option value="Java">Java</option>
                                <option value=".NET">.NET</option>
                                <option value="iOS">iOS</option>
                                <option value="Android">Android</option>
                                <option value="Lead">Lead</option>
                                <option value="Design">Design</option>
                                <option value="PHP">PHP</option>
                                <option value="Python">Python</option>
                                <option value="Ruby">Ruby</option>
                                <option value="C++">C++</option>
                                <option value="Unity">Unity</option>
                                <option value="QA">QA</option>
                                <option value="SQL">SQL</option>
                                <option value="Sysadmin">Sysadmin</option>
                                <option value="Embedded">Embedded</option>
                                <option value="Project Manager">Project Manager</option>
                                <option value="Product Manager">Product Manager</option>
                                <option value="Business Analyst">Business Analyst</option>
                                <option value="HR">HR</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Other">Other</option>
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
                            <li>Примеры хорошо заполненых профилей <a href="/developers/?sortby=rating">смотрите здесь</a>.
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

    </form>
</template>