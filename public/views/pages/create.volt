{% if LoggedUser %}
    <add-post :user-id="{{ LoggedUser.getId() }}"></add-post>
{% else %}
    <h1 class="uk-text-center uk-text-danger">Доступ закрыт!</h1>
{% endif %}
