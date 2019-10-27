{% if LoggedUser %}
    {% if LoggedUser.getUserAvatar() %}
        {% set userAvatar = LoggedUser.getUserAvatar().getSrc() %}
    {% endif %}
    <profile :user="{{ LoggedUser | json_encode | escape }}"
             :avatar="{{ userAvatar | json_encode | escape }}"></profile>
{% else %}
    <h1 class="uk-text-center uk-text-danger">Доступ закрыт!</h1>
{% endif %}
