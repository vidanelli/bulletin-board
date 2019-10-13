<article class="uk-card uk-card-body uk-card-small uk-article">

    <header class="mg-article-header uk-text-center">
        {% if Post.getImage().getSrc() %}
            <img class="uk-margin" src="{{ Post.getImage().getSrc() }}" />
        {% endif %}

        <h1 class="uk-article-title uk-margin-remove-bottom">{{ Post.getName() }}</h1>

        <div class="uk-article-meta">
            <time>{{ datetime.parse(Post.getCreatedAt()).format('d-m-Y H:s') }}</time>
            <p class="uk-margin-remove-top">Запись пользователя <a href="/users/{{ Post.getUser().id }}">{{ Post.getUser().first_name }}</a></p>
        </div>
    </header>

    <div class="uk-container uk-container-small uk-article-body">
        {{ Post.getDescription() }}
    </div>

</article>
