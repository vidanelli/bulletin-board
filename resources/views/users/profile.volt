{% if LoggedUser %}
    <profile :user="{{ LoggedUser | json_encode | escape }}"
             :user-avatar="{{ !LoggedUser.getUserAvatar() ? '{}' : LoggedUser.getUserAvatar() | json_encode | escape }}"></profile>
{% else %}
    <h1 class="uk-text-center uk-text-danger">Доступ закрыт!</h1>
{% endif %}
