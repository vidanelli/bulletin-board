<div class="uk-grid-medium uk-child-width-1-1"
     uk-grid>

     <!-- Title -->
     <div class="uk-text-center">
        <h1>Доска объявлений</h1>
     </div>

    <div>
        <div class="uk-container">
            <div class="uk-child-width-1-2@m uk-child-width-1-3@l" uk-height-match=".uk-card-body" uk-grid>
                {% for Post in Posts %}
                    <div>
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-media-top">
                                <div class="uk-text-center">
                                    <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                                        <img class="uk-transition-scale-up uk-transition-opaque" data-src="{{ Post.getImage().getSrc() }}" data-width="1000" data-height="667" uk-img>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <h3 class="uk-card-title uk-margin-remove-bottom">{{ Post.name }}</h3>
                                <p class="uk-article-meta uk-margin-remove-top">Запись пользователя <a href="/users/{{ Post.getUser().id }}">{{ Post.getUser().first_name }}</a></p>
                                <p class="uk-text-truncate">{{ Post.description }}</p>
                            </div>
                            <div class="uk-card-footer">
                                <div class="uk-flex uk-flex-between">
                                    <a class="uk-button uk-button-default" href="/posts/{{ Post.id }}">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                {% endfor %}
            </div>

            {% if Paginator.total_pages > 1 %}
                <pagination :current-page="{{ Paginator.current }}"
                            :total-pages="{{ Paginator.total_pages }}"></pagination>
            {% endif %}
        </div>
    </div>

</div>
