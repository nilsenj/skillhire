<template>
    <div class="col-sm-8">
        <p class="lead">Show Your skill and its level&nbsp;.</p>

        <form id="add-skill" class="skills-form">
            <div class="form-group">
                <label class="typo__label">Your Skills</label>
                <multiselect v-model="selectedSkill" id="ajax" @tag="addTag" :taggable="true" label="name"
                             track-by="code" placeholder="Type to search" :options="skills" :multiple="false"
                             :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false"
                             :close-on-select="false" :options-limit="300" :limit="50" :limit-text="limitText"
                             @search-change="all"><span slot="noResult">Oops! No skills found. Consider changing the search query.</span>
                </multiselect>
            </div>
            <div class="skills-table-wrapper">
                <table id="skills-table" class="skills-table editable">
                    <tbody>
                    <tr v-for="item in userSkillSet" style="margin-top: 15px;">
                        <td class="skill-name"><h4 style="padding-right: 10px;">{{item.name}}</h4></td>
                        <td class="skill-score text-right">
                            <star-rating :max-rating="10" @rating-selected="updateCounter(item.counter, $event)"
                                         :rating="item.counter.counter" :showRating="false" :star-size="28"></star-rating>
                        </td>
                        <td class="text-danger skill-remove">
                            <button v-on:click="deleteTag(item, $event)" style="margin-left: 15px" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating'
    import Multiselect from 'vue-multiselect'
    export default {
        data() {
            return {
                autocompleteData: [],
                skills: [],
                skillsCount: '',
                skillnames: [],
                selectedSkill: '',
                userSkillSet: [],
                userSkillSetCount: '',
                isLoading: false,
                error: {}
            }
        },
        methods: {
            userSkills() {
                this.$http.get('api/skills/userSkills').then(response => {

                    // get body data
                    this.userSkillSet = response.body.items;
                    this.userSkillSetCount = response.body.count;
                    console.log(response.body)
                }, response => {
                    // error callback
                });
            },

            all(query) {
                this.isLoading = true;
                this.$http.get('api/skills/all?q=' + query).then(response => {

                    // get body data
                    this.skills = response.body.items;
                    this.skillsCount = response.body.count;
                    this.isLoading = false

                }, response => {
                    // error callback
                });
            },
            attachUserSkill(skill) {
                this.$http.put('api/skills/userSkills', {tags_list: skill}).then(response => {
                    console.log(response.body);
                    this.userSkills();
                }, response => {
                    // error callback
                });
            },
            addTag (newTag) {
                event.preventDefault();
                this.attachUserSkill(newTag);
            },
            getData(data) {
                console.log(data);
            },
            limitText (count) {
                return `and ${count} other skills`
            },
            updateCounter (counter, event) {
                counter.counter = event;
                this.$http.put('api/skills/updateSkillCounter', {counter: counter}).then(response => {
                    this.userSkills();
                }, response => {
                    // error callback
                });
            },
            deleteTag (tag, event) {
                event.preventDefault();
                this.$http.post('api/skills/deleteSkill', {tag: tag}).then(response => {
                    this.userSkills();
                }, response => {
                    // error callback
                });
            }
        },
        mounted: function () {
            this.userSkills();
        },
        components: {
            StarRating,
            Multiselect
        },
    }
</script>