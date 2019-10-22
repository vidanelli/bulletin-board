<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/public/dist/css/danelli.css">
        <title>Bulletin Board Project</title>
    </head>
    <body>

        <div id="danelli">

            <header>
                <div uk-sticky="" class="uk-navbar-container tm-navbar-container uk-sticky uk-sticky-fixed">
                    <div class="uk-container uk-container-expand">
                        <nav uk-navbar="" class="uk-navbar">
                            <div class="uk-navbar-left">
                                <a href="/" class="uk-navbar-item uk-logo">Bulletin Board Project</a>
                            </div>
                            <div class="uk-navbar-right">
                                <ul class="uk-navbar-nav">
                                    <li class="uk-active">
                                        <a class="uk-navbar-item uk-icon-link uk-link-text" href="#" uk-icon="icon: user; ratio: 1.7" aria-expanded="false"></a>
                                        <div uk-dropdown="pos: bottom-right; mode: click; offset: -17;" class="uk-dropdown">
                                            {% if LoggedUser %}
                                               <ul class="uk-nav uk-navbar-dropdown-nav">
                                                   <li class="uk-nav-header">{{ LoggedUser.getFirstName() }}</li>
                                                   <li><a href="/users/profile">Профиль</a></li>
                                                   <li><a href="/users/change/password">Изменить пароль</a></li>
                                                   <li><a href="/pages/create">Добавить объявление</a></li>
                                                   <li><a href="/users/logout">Выход</a></li>
                                               </ul>
                                            {% else %}
                                               <ul class="uk-nav uk-navbar-dropdown-nav">
                                                   <li><a href="/users/login">Вход</a></li>
                                                   <li><a href="/users/signup">Регистрация</a></li>
                                               </ul>
                                            {% endif %}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </header>

            <main uk-height-viewport="expand: true">
                <div class="uk-section uk-section-medium">
                    <div class="uk-container uk-container-large">
                        {{ content() }}
                    </div>
                </div>
            </main>

        </div>

        <script src="/public/dist/js/vendor.js"></script>
        <script src="/public/dist/js/danelli.js"></script>

    </body>
</html>
