<template>
    <div>
        <div v-if="finished === true">
            <div class="uk-text-center">
                <h1 class="uk-margin-remove uk-text-success">Объявление успешно опубликовано!</h1>
            </div>
        </div>
        <div v-else>
            <div class="uk-text-center">
                <h1 class="uk-margin-remove">Добавление нового объявления</h1>
            </div>
            <div class="uk-section uk-section-default">
                <div class="uk-container uk-container-small uk-flex uk-flex-middle uk-flex-center">
                    <div class="uk-width-large">

                        <div class="uk-width-1-1">
                            <label class="uk-form-label">Название</label>
                            <div class="uk-form-controls">
                                <input v-model="formData.postData.name"
                                       :class="{' uk-form-danger': errors.has('name')}"
                                       v-validate="{required: true}"
                                       class="uk-input"
                                       name="name"
                                       type="text">
                            </div>
                        </div>

                        <div class="uk-width-1-1">
                            <label class="uk-form-label">Описание</label>
                            <div class="uk-form-controls">
                                <textarea v-model="formData.postData.description"
                                          :class="{' uk-form-danger': errors.has('description')}"
                                          v-validate="{required: true}"
                                          class="uk-textarea"
                                          name="description"></textarea>
                            </div>
                        </div>

                        <div class="uk-margin-top">
                            <div uk-form-custom="" class="uk-form-custom">
                                <div v-if="image">
                                    <img class="uk-margin-bottom" :src="image" />
                                </div>
                                <input @change="onFileChange"
                                       name="file"
                                       type="file">
                                <button class="uk-button uk-button-default uk-button-small" type="button" tabindex="-1">
                                    Upload new picture
                                </button>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <input @click="send" class="uk-button uk-button-primary" value="Добавить" type="submit">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "AddPost",
        props: {
            userId: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                formData: {
                    postData: {
                        name: '',
                        description: ''
                    },
                    userId: this.userId,
                    file: ''
                },
                finished: false,
                image: ''
            }
        },
        methods: {
            send() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        let formData = new FormData();
                        formData.append('file', this.formData.file);
                        formData.append('name', this.formData.postData.name);
                        formData.append('description', this.formData.postData.description);
                        formData.append('userId', this.formData.userId);

                        this.$http.post('/users/addPost', formData).then(response => {
                            this.finished = true;
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
            removeImage: function (e) {
              this.image = '';
            }
        }
    }
</script>
