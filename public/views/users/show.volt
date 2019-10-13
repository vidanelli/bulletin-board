<div class="uk-container uk-container-medium">
    <div class="uk-grid-medium uk-grid" uk-grid>

        <div class="uk-width-1-1 uk-width-1-4@m">
            <div class="uk-card uk-card-default">
                <div class="uk-card-media-top uk-text-center">
                    {% if User.getUserAvatar() %}
                        <img src="{{ User.getUserAvatar().getSrc() }}" alt="">
                    {% endif %}
                </div>
                <div class="uk-card-body">
                    <h3 class="uk-card-title">{{ User.getFirstName() }}</h3>
                    {% if User.getAboutMe() %}
                        <p>{{ User.getAboutMe() }}</p>
                    {% endif %}
                    <div>
                        {% if userAverageRating > 0 %}
                            <div class="uk-flex site-user-stars">
                                <p>Rating:</p>
                                {% set numbers = 1..5 %}
                                {% for i in numbers %}
                                    {% if i <= userAverageRating %}
                                        <img src="/public/assets/images/star-on.svg" />
                                    {% else %}
                                        <img src="/public/assets/images/star-off.svg" />
                                    {% endif %}
                                {% endfor %}
                            </div>
                        {% endif %}
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-width-1-1 uk-width-expand@m">
            {% if Comments %}
                <ul class="uk-list uk-list-large">
                    {% for Comment in Comments %}
                        <li>
                            <article class="uk-comment uk-card uk-card-body uk-card-default">
                                <header class="uk-comment-header uk-position-relative">
                                    <div class="uk-grid-medium uk-flex-middle" uk-grid>
                                        {# <div class="uk-width-auto">
                                            <img class="uk-comment-avatar" src="" width="80" height="80" alt="">
                                        </div> #}
                                        <div class="uk-width-1-1 uk-width-expand@m">
                                            <h4 class="uk-comment-title uk-margin-remove">{{ Comment.author }}</h4>
                                            <p class="uk-comment-meta uk-margin-remove-top">
                                                {{ datetime.parse(Comment.created_at).format('d-m-Y H:i') }}
                                            </p>
                                        </div>
                                        {% if Comment.rating > 0 %}
                                            <div class="comment-stars">
                                                {% for i in numbers %}
                                                    {% if i <= Comment.rating %}
                                                        <img src="/public/assets/images/star-on.svg" />
                                                    {% else %}
                                                        <img src="/public/assets/images/star-off.svg" />
                                                    {% endif %}
                                                {% endfor %}
                                            </div>
                                        {% endif %}
                                    </div>
                                </header>
                                <div class="uk-comment-body">
                                    <p>{{ Comment.message }}</p>
                                </div>
                            </article>
                        </li>
                    {% endfor %}
                </ul>
            {% else %}
                <article class="uk-comment uk-card uk-card-body uk-card-default">
                    Комментариев пока нет!
                </article>
            {% endif %}
        </div>

        <add-comment :user-id="{{ User.getId() }}"></add-comment>

    </div>


</div>
