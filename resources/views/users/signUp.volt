{% if LoggedUser %}
    <h1 class="uk-text-center">Ошибка!</h1>
    <div class="uk-text-success uk-text-center">
      {{ LoggedUser.getFirstName() }}, Вы уже зарегестрированы на нашем сайте!
    </div>
{% else %}
    <sign-up></sign-up>
{% endif %}
