<template>
    <div>
        <div v-if="finished === false">
            <div class="uk-section uk-section-default">
                <div class="uk-container uk-container-small uk-flex uk-flex-middle uk-flex-center">
                    <div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                <input v-model="formData.email"
                                       :class="{' uk-form-danger': errors.has('email')}"
                                       v-validate="{required: true, email: true}"
                                       class="uk-input"
                                       name="email"
                                       type="email"
                                       placeholder="Ваш Email">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input v-model="formData.name"
                                       :class="{' uk-form-danger': errors.has('name')}"
                                       v-validate="{required: true}"
                                       class="uk-input"
                                       name="name"
                                       type="text"
                                       placeholder="Ваше имя">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                <input v-model="formData.password"
                                       :class="{' uk-form-danger': errors.has('password')}"
                                       v-validate="{required: true, min: 4}"
                                       ref="password"
                                       class="uk-input"
                                       name="password"
                                       type="password"
                                       placeholder="Ваш пароль">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                <input :class="{' uk-form-danger': errors.has('passwordConfirm')}"
                                       v-validate="'required|confirmed:password'"
                                       class="uk-input"
                                       name="passwordConfirm"
                                       type="password"
                                       placeholder="Подтвердите пароль">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <input @click="send" class="uk-button uk-button-primary" value="Регистрация" type="submit">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <h1 class="uk-text-center">Неудача!</h1>
            <div class="uk-text-danger uk-text-center">{{ errorMessage }}</div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "SignUp",
        data() {
            return {
                formData: {
                    email: '',
                    name: '',
                    password: '',
                    rememberMe: true,
                },
                finished: false,
                errorStatus: false,
                errorMessage: ''
            }
        },
        methods: {
            send() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$http.post('/users/signUp', this.formData).then(response => {
                            this.finished = true;
                            if (response.body.success === true) {
                                window.location.href = '/users/profile';
                            } else {
                                this.errorStatus = true;
                                this.errorMessage = response.body.data.errorMessage;
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
