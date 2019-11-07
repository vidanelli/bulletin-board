<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

return [
    'modules' => [
        'Users' => [
            'className' => App\Modules\Users\UsersModule::class,
            'provider' =>  App\Modules\Users\UsersModuleServiceProvider::class,
        ],
        'Posts' => [
            'className' => App\Modules\Posts\PostsModule::class,
            'provider' =>  App\Modules\Posts\PostsModuleServiceProvider::class,
        ],
        'Home' => [
            'className' => App\Modules\Home\HomeModule::class,
            'provider' =>  App\Modules\Home\HomeModuleServiceProvider::class,
        ],
    ]
];
