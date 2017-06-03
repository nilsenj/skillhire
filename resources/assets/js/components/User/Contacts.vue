<template>
    <form v-on:submit="updateContact" class="form-horizontal form-horizontal-text-left js-account-form" method="post" id="contact-dropzone">
        <div class="row">
            <div class="col-sm-10">

                <div class="row">
                    <div class="col-sm-10">
                        <p class="lead">Поиск работы на Джинне анонимен. Ваши персональные данные увидят только те, кому вы решите открыть контакты.</p>
                        <br>
                    </div>
                </div>




                <div class="form-group">

                    <label class="col-sm-3 control-label" for="name">Fullname</label>

                    <div class="col-sm-7">
                        <input type="text" name="name" v-model="contact.fullname" id="name" class="form-control" placeholder="Ivan Ivanov">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Profile Image</label>

                    <div class="col-sm-7">
                        <VueImgInputer v-model="file" accept="image/*" theme="light" bottomText="click to change profile image" placeholder="please select profile image" size="small" @onChange="fileChange"></VueImgInputer>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="email">Email</label>

                    <div class="col-sm-7">
                        <input disabled="" v-model="contact.email" type="text" name="email" id="email" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="skype">Skype</label>

                    <div class="col-sm-7">
                        <input type="text" v-model="contact.skype" name="skype" id="skype" class="form-control" placeholder="me1992">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="mobile">Mobile Phone</label>

                    <div class="col-sm-7">
                        <input type="tel"  v-model="contact.mobile" name="mobile" id="mobile" class="form-control" placeholder="+380936555666">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="telegram">Telegram</label>

                    <div class="col-sm-7">
                        <input type="text" name="telegram" id="telegram" class="form-control" v-model="contact.telegram">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="linkedin">LinkedIn</label>

                    <div class="col-sm-7">
                        <input type="text" name="linkedin" id="linkedin" v-model="contact.linkedin" class="form-control" placeholder="https://ua.linkedin.com/in/ivan-ivanov-999999a9">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="github">GitHub</label>

                    <div class="col-sm-7">
                        <input type="text" name="github" id="github" class="form-control" v-model="contact.github" placeholder="https://github.com/storecamp/storecamp">
                    </div>
                </div>

                <a name="cv"></a>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="github">Resume</label>

                    <div class="col-sm-7" style="margin-top: 7px; margin-bottom: 20px;">


                        <input type="file" class="js-cv-input" name="js-cv-input" id="inbox-contact-cv" style="display: none;">
                        <span class="js-cv-status"><a href="http://cv.djinni.co/2d/c5edc1de8d11e69a67e910b2e717fe/PHP_Angular2NikolenkoIvan.docx.docx" target="_blank">PHP_Angular2NikolenkoIvan.docx.docx</a></span>
                        <a href="#" class="js-cv-remove-link close inline-close">×</a>


                        <input type="hidden" class="js-cv-filename">
                        <input type="hidden" class="js-cv-url" name="cv_url">
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-offset-3 col-sm-7">
                            <input type="submit" name="save_changes" class="btn btn-primary btn-lg form_btn" value="Save Changes">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
<style>
    .img-inputer--small {
        height: 100%!important;
        min-height: 160px;
    }
</style>
<script>
    import auth from '../../auth.js';
    import vueSlider from 'vue-slider-component'
    import Multiselect from 'vue-multiselect'
    import VueImgInputer from 'vue-img-inputer'

    export default {
        data() {
            return {
                file: {},
                contact: {
                },
                error: false,
                errorMsg: ''
            }
        },
        methods: {
            showContact() {
                Vue.http.get(
                    'api/contacts/show'
                ).then(response => {
                    this.error = false;
                    this.contact = response.data;
                }, response => {
                    this.error = true
                    this.errorMsg = response.error
                })
            },
            updateContact(event) {
                event.preventDefault();
                let contact = this.contact;
                Vue.http.put(
                    'api/contacts/update',
                    contact
                ).then(response => {
                    this.error = false;
                    this.contact = this.showContact();
                }, response => {
                    this.error = true
                    this.errorMsg = response.error
                })
            },
            fileChange(file, name) {
                console.log('File:', file);
                console.log('FileName:', name);
            }

        },
        mounted: function () {
            this.showContact();
        },
        components: {
            vueSlider,
            Multiselect,
            VueImgInputer
        }
    }
</script>