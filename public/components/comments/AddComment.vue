<template>
    <div class="uk-width-1-1 ">
        <div class="uk-card uk-card-body uk-card-default">
            <div v-if="finished === false" class="uk-width-1-1 uk-grid-medium" uk-grid>

                <div class="uk-width-1-1">
                    <label class="uk-form-label">Ваше имя</label>
                    <div class="uk-width-medium uk-form-controls">
                        <input v-model="formData.commentData.author"
                               :class="{' uk-form-danger': errors.has('author')}"
                               v-validate="{required: true, alpha_spaces: true }"
                               name="author"
                               placeholder="Ваше имя"
                               class="uk-input"
                               type="text">
                    </div>
                </div>

                <div class="uk-width-1-1">
                    <label class="uk-form-label">Комментарий</label>
                    <div class="uk-form-controls">
                        <textarea v-model="formData.commentData.message"
                                  :class="{' uk-form-danger': errors.has('text')}"
                                  v-validate="{ required: true, min: 5 }"
                                  placeholder="Ваш комментарий"
                                  name="text"
                                  class="uk-textarea"
                                  rows="3"></textarea>
                    </div>
                </div>

                <div class="uk-flex comment-stars">
                    <div @mouseenter="cancel = true" @mouseleave="cancel = false">
                        <a @click="formData.commentData.rating = 0;">
                            <img v-if="!cancel" src="/public/assets/images/cancel-off.svg" class="rating-cancel">
                            <img v-else src="/public/assets/images/cancel-on.svg" class="rating-cancel">
                        </a>
                    </div>
                    <star-rating :border-width="2"
                             border-color="#000"
                             :star-points="[26.934,1.318, 35.256,18.182, 53.867,20.887, 40.4,34.013, 43.579,52.549, 26.934,43.798, 10.288,52.549, 13.467,34.013, 0,20.887, 18.611,18.182]"
                             star-size="32"
                             :show-rating="false"
                             v-model="formData.commentData.rating"></star-rating>
                </div>

                <div class="uk-width-1-1 uk-text-left">
                    <input class="uk-button uk-button-primary" @click="send" value="Отправить" type="submit">
                </div>

            </div>

            <div v-else>
                <p class="uk-text-center uk-text-success">Комментарий успешно добавлен!</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddComment",
        props: {
            userId: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                formData: {
                    commentData: {
                        author: '',
                        message: '',
                        rating: 0
                    },
                    userId: this.userId
                },
                finished: false,
                cancel: false
            }
        },
        methods: {
            send() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$http.post('/users/comment/add', this.formData).then(response => {
                            this.finished = true;
                        }, response => {
                        })
                    }
                });
            }
        },
    }
</script>
