<template>
    <div>
        <div v-if="finished === false">
            <div class="uk-section uk-section-default">
                <div class="uk-container uk-container-small uk-flex uk-flex-middle uk-flex-center">
                    <div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input v-model="formData.passwordData.oldPassword"
                                       :class="{' uk-form-danger': errors.has('old_password')}"
                                       v-validate="{required: true}"
                                       class="uk-input"
                                       name="old_password"
                                       type="password"
                                       placeholder="Старый пароль">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                <input v-model="formData.passwordData.newPassword"
                                       :class="{' uk-form-danger': errors.has('new_password')}"
                                       v-validate="{required: true}"
                                       ref="new_password"
                                       class="uk-input"
                                       name="new_password"
                                       type="password"
                                       placeholder="Новый пароль">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                <input v-model="formData.passwordData.passwordConfirm"
                                       :class="{' uk-form-danger': errors.has('password_confirm')}"
                                       v-validate="'required|confirmed:new_password'"
                                       class="uk-input"
                                       name="password_confirm"
                                       type="password"
                                       placeholder="Новый пароль ещё раз">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <input @click="send" class="uk-button uk-button-primary" value="Изменить" type="submit">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div v-if="success === true">
                <h1 class="uk-text-center uk-text-success">Пароль успешно изменён!</h1>
            </div>
            <div v-else>
                <h1 class="uk-text-center uk-text-danger">Изменить пароль не удалось!</h1>
                <div class="uk-text-center">Возможно, Вы неверно указали старый пароль.</div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "ChangePassword",
        props: {
            userId: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                formData: {
                    passwordData: {
                        oldPassword: '',
                        newPassword: '',
                        passwordConfirm: ''
                    },
                    userId: this.userId
                },
                finished: false,
                success: false
            }
        },
        methods: {
            send() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$http.post('/users/change/password', this.formData).then(response => {
                            this.finished = true;
                            if (response.body.success === true) {
                                this.success = true;
                            }
                        }, response => {
                            // error callback
                        });
                    }
                }).catch(() => {

                });
            }
        }
    }
</script>
