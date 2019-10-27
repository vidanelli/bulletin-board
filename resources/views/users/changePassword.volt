{% if LoggedUser %}
    <change-password :user-id="{{ LoggedUser.getId() }}"></change-password>
{% else %}
    <h1 class="uk-text-center uk-text-danger">Доступ закрыт!</h1>
{% endif %}
