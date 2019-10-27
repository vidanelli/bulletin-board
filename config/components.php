<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

return [
    'components' => [
        'users' => [
            'provider' => BulletinBoardProject\ServiceComponents\Users\UsersComponentProvider::class,
        ],
        'posts' => [
            'provider' => BulletinBoardProject\ServiceComponents\Posts\PostsComponentProvider::class,
        ],
    ]
];
