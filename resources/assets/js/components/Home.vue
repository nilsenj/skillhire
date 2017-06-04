<template>
    <div class="container">
        <h1>Skillhire</h1>
        <div class="row">
            <div class="col-sm-8">
                <h3>Find Employers here</h3>
                <form action="/recruiters/" method="get" class="form form-inline">
                    <div class="form-group">
                        <input type="text" placeholder="Skill or keyword" id="keywords" name="keywords" class="input form-control" value="PHP">
                    </div>

                    <div class="form-group">
                        <input type="text" placeholder="Город" id="city" name="city" class="input form-control" autocomplete="off" data-provide="typeahead" value="remote">
                    </div>

                    <input type="submit" class="btn btn-primary input" value="Find Vacancy">
                </form>
            </div>

            <div class="col-sm-4">

                <h4>Latest Profile views</h4>
                <table class="table">
                    <tbody><tr>
                        <td width="50" valign="top" style="padding-right: 7px;">

                            <a href="/r/23080-cto-at-sunsoft-pro/">
                                <img class="userpic" src="https://p.djinni.co/1ddba23c3c/200.jpg" alt="Sergey">
                            </a>


                        </td>

                        <td>
                            <p class="recruiter-name"><a href="/r/23080-cto-at-sunsoft-pro/">Sergey Martynovych</a></p>
                            <p class="recruiter-headline">CTO at sunsoft.pro</p>
                            <p class="recruiter-additional">
                                <small></small>
                            </p>
                        </td>
                    </tr>
                    </tbody></table>


                <table class="table">
                    <tbody><tr>
                        <td width="50" valign="top" style="padding-right: 7px;">

                            <a href="/r/8903-co-founder-ceo-at-innoteka/">
                                <img class="userpic" src="https://p.djinni.co/r/831ee591b9/50.jpg" alt="Roman">
                            </a>


                        </td>

                        <td>
                            <p class="recruiter-name"><a href="/r/8903-co-founder-ceo-at-innoteka/">Roman Voznyy</a></p>
                            <p class="recruiter-headline">Co-Founder &amp; CEO at Innoteka</p>
                            <p class="recruiter-additional">
                                <small></small>
                            </p>
                        </td>
                    </tr>
                    </tbody></table>


                <table class="table">
                    <tbody><tr>
                        <td width="50" valign="top" style="padding-right: 7px;">

                            <a href="/r/20936-hr-at-infusemedia/">
                                <img class="userpic" src="/static/i/default-userpic@2x.png" alt="Шиян">
                            </a>

                        </td>

                        <td>
                            <p class="recruiter-name"><a href="/r/20936-hr-at-infusemedia/">Шиян Ксения</a></p>
                            <p class="recruiter-headline">HR at InfuseMedia</p>
                            <p class="recruiter-additional">
                                <small></small>
                            </p>
                        </td>
                    </tr>
                    </tbody></table>

            </div>
        </div>
    </div>
</template>