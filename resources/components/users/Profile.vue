<template>
    <div>
        <div v-if="finished === true">
            <h1 class="uk-text-center uk-text-success">Изменения успешно сохранены!</h1>
        </div>
        <div class="uk-form-stacked">
            <div class="uk-card uk-card-small">

                <header class="uk-card-header">
                    <h2>Редактирование профиля</h2>
                </header>

                <div class="uk-container uk-container-small uk-grid-margin">
                    <div class="uk-card-body">
                        <div class="uk-grid-medium uk-grid uk-grid-stack" uk-grid>

                            <div class="uk-width-1-3 uk-first-column">
                                <div v-if="image">
                                    <img :src="image" class="uk-border-rounded" />
                                </div>
                                <div v-else>
                                    <div v-if="avatar">
                                        <img :src="avatar" class="uk-border-rounded">
                                    </div>
                                    <div v-else>
                                        <img src="/resources/assets/images/no-image.png" class="uk-border-rounded">
                                    </div>
                                </div>
                                <div class="uk-margin-top uk-text-center">
                                    <div class="uk-form-custom" uk-form-custom>
                                        <input @change="onFileChange"
                                               name="file"
                                               type="file">
                                        <button class="uk-button uk-button-default uk-button-small" type="button">Upload new picture</button>
                                    </div>
                                </div>
                                <div class="uk-margin-small-top uk-text-center">
                                    <button class="uk-button uk-button-default uk-button-small" type="button" @click="deleteImage">Delete image</button>
                                </div>
                            </div>

                            <div class="uk-width-expand">
                                <div class="uk-grid-small uk-grid" uk-grid="">

                                    <div class="uk-width-1-2 uk-first-column">
                                        <label class="uk-form-label">First Name</label>
                                        <div class="uk-form-controls">
                                            <input v-model="formData.profileData.first_name"
                                                   :class="{' uk-form-danger': errors.has('first_name')}"
                                                   v-validate="{required: true}"
                                                   class="uk-input"
                                                   name="first_name"
                                                   type="text">
                                        </div>
                                    </div>

                                    <div class="uk-width-1-2">
                                        <label class="uk-form-label">Last Name</label>
                                        <div class="uk-form-controls">
                                            <input v-model="formData.profileData.last_name"
                                                   class="uk-input"
                                                   name="last_name"
                                                   type="text">
                                        </div>
                                    </div>

                                    <div class="uk-width-1-2 uk-grid-margin uk-first-column">
                                        <label class="uk-form-label">Gender</label>
                                        <div class="uk-form-controls">
                                            <select v-model="formData.profileData.gender"
                                                    class="uk-select"
                                                    name="gender">
                                                <option v-for="gender in genders"
                                                        :value="gender.value">{{ gender.text }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-width-1-2 uk-grid-margin">
                                        <label class="uk-form-label">Birthday</label>
                                        <div class="uk-form-controls">
                                            <input v-model="formData.profileData.birthday"
                                                   class="uk-input"
                                                   name="birthday"
                                                   type="date">
                                        </div>
                                    </div>

                                    <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                        <label class="uk-form-label">Location</label>
                                        <div class="uk-form-controls">
                                            <input v-model="formData.profileData.location"
                                                   class="uk-input"
                                                   name="location"
                                                   type="text">
                                        </div>
                                    </div>

                                    <div class="uk-width-1-1 uk-grid-margin uk-first-column">
                                        <label class="uk-form-label">Bio</label>
                                        <div class="uk-form-controls">
                                            <textarea v-model="formData.profileData.about_me"
                                                      class="uk-textarea"
                                                      name="about_me"
                                                      rows="3"
                                                      placeholder="Tell us a little bit about yourself"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="uk-text-center uk-grid-margin uk-first-column">
                            <input @click="send" class="uk-button uk-button-primary" type="submit" value="Save">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Profile",
        props: {
            user: {
                type: Object,
                required: true
            },
            userAvatar: {
                type: Object,
                default() {
                    return {};
                }
            }
        },
        data() {
            return {
                formData: {
                    profileData: {
                        first_name: this.user.first_name,
                        last_name: this.user.last_name,
                        gender: this.user.gender,
                        birthday: this.user.birthday,
                        location: this.user.location,
                        about_me: this.user.about_me
                    },
                    userId: this.user.id,
                    file: ''
                },
                finished: false,
                image: '',
                avatar: Object.keys(this.userAvatar).length !== 0 ? this.userAvatar.src : '',
                genders: [
                  { text: '', value: '' },
                  { text: 'Male', value: 'Male' },
                  { text: 'Female', value: 'Female' }
                ]
            }
        },
        methods: {
            send() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        let formData = new FormData();
                        formData.append('file', this.formData.file);
                        $.each(this.formData.profileData, function(index, value) {
                            formData.append('profileData['+index+']', value);
                        });
                        formData.append('userId', this.formData.userId);
                        formData.append('avatar', this.avatar);

                        this.$http.post('/users/profile', formData).then(response => {
                            this.finished = true;
                            this.image = '';
                            if (response.body.avatar) {
                                this.avatar = response.body.avatar;
                            }
                        }, response => {
                            // error callback
                        });
                    }
                }).catch(() => {

                });
            },
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length || files[0].size > 15728640) {
                    return;
                }
                this.formData.file = files[0];
                this.createImage(files[0]);
            },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            deleteImage: function (e) {
              this.image = '';
              this.avatar = '';
              this.formData.file = '';
            },
            getUserName() {
                return this.user.first_name;
            }
        }
    }
</script>
