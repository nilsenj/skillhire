<template>
    <form v-on:submit="updateContact" class="form-horizontal form-horizontal-text-left js-account-form" method="post" id="updateContact">
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
                        <VueImgInputer v-model="file" :imgSrc="contact.avatar" accept="image/*" theme="light" bottomText="click to change profile image" placeholder="please select profile image" size="small" @onChange="fileChange"></VueImgInputer>
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
                    <label class="col-sm-3 control-label" >Resume</label>
                    <div class="col-sm-7">
                        <File name="resume" :fileUpload="fileUpload" :already_exists_file="already_exists_file" inputId="resume"></File>
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
    import File from '../FileUpload/Main.vue'
    import * as uploader from '../../services/file-upload.service.js';

    export default {
        data() {
            return {
                file: {},
                resume: {},
                contact: {
                    avatar: null,
                    created_at: "",
                    email: "",
                    fullname: "",
                    github: "",
                    id: null,
                    linkedin:"",
                    mobile: "",
                    original_resume_name: "",
                    resume: "",
                    skype: "",
                    telegram: "",
                    updated_at: "",
                    user_id: null
                },
                fileUpload: null,
                error: false,
                errorMsg: '',
                already_exists_file: null
            }
        },
        methods: {
            showContact() {
                Vue.http.get(
                    'api/contacts/show'
                ).then(response => {
                    this.error = false;
                    this.contact = response.data;
                    this.fileUpload = null;
                    if(this.contact.resume) {
                        this.already_exists_file = {
                            fileName: this.contact.original_resume_name,
                            url: this.contact.resume
                        };
                    } else {
                        this.already_exists_file = null;
                    }
                }, response => {
                    this.error = true;
                    this.errorMsg = response.error
                })
            },
            updateContact(event) {
                event.preventDefault();
                let contact = this.contact;
                contact.file_status = $("input[name='file_status']").val();
                let resume = $("#resume").prop('files');
                if(resume.length) {
                    this.resume = resume[0];
                }
                Vue.http.put(
                    'api/contacts/update',
                    contact
                ).then(response => {
                    this.error = false;
                    this.contactUpload();
                }, response => {
                    this.error = true
                    this.errorMsg = response.error
                })
            },
            contactUpload() {
                const avatarformData = new FormData();
                const resumeFormData = new FormData();
                if(this.file.name) {
                    avatarformData.append('file', this.file, this.file.name);
                    uploader.uploadAvatar(avatarformData);
                }
                let resumeStatus = $("input[name='file_status']").val();
                let updateStatus = true;
                if(this.resume.name) {
                    resumeFormData.append('resume', this.resume, this.resume.name);
                    resumeFormData.append('file_status',  $("input[name='file_status']").val());
                    uploader.uploadResume(resumeFormData, this);
                    updateStatus = false;
                    this.$root.$emit('resume_changed');
                }
                if(resumeStatus == 'removed') {
                    resumeFormData.append('file_status',  $("input[name='file_status']").val());
                    uploader.uploadResume(resumeFormData, this);
                    updateStatus = false;
                    this.$root.$emit('resume_changed');
                }
                if(updateStatus) {
                    this.showContact();
                }
            },
            fileChange(file, name) {
                console.log(file);
                console.log('FileName:', name);
            }

        },
        mounted: function () {
            this.showContact();

        },
        components: {
            vueSlider,
            Multiselect,
            VueImgInputer,
            File
        }
    }
</script>