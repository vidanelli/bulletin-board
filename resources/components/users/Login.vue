<template>
    <div>
        <div v-if="finished === true && success === false">
            <h1 class="uk-text-danger uk-text-center">Пользователь не найден!</h1>
            <div class="uk-text-center">Проверьте правильность введённых данных и повторите попытку.</div>
        </div>
        <div class="uk-section uk-section-default">
            <div class="uk-container uk-container-small uk-flex uk-flex-middle uk-flex-center">
                <div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                <input v-model="formData.userData.email"
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
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                <input v-model="formData.userData.password"
                                       :class="{' uk-form-danger': errors.has('password')}"
                                       v-validate="{required: true, min: 4}"
                                       class="uk-input"
                                       name="password"
                                       type="password"
                                       placeholder="Ваш пароль">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline">
                                <input @click="login" class="uk-button uk-button-primary" value="Вход" type="submit">
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Login",
        data() {
            return {
                formData: {
                    userData: {
                        email: '',
                        password: '',
                    },
                    rememberMe: true,
                },
                finished: false,
                success: false
            }
        },
        methods: {
            login() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$http.post('/users/login', this.formData).then(response => {
                            this.finished = true;
                            if (response.body.success === true) {
                                this.success = true;
                                window.location.href = '/users/profile';
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
