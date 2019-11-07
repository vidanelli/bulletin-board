<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Posts;

use App\Core\Mvc\Module\ModuleServiceProvider;
use App\Modules\Posts\Providers\Shared\{
    RoutesServiceProvider,
    PostsRepositoryServiceProvider,
};

class PostsModuleServiceProvider extends ModuleServiceProvider
{
    protected $providers = [
        RoutesServiceProvider::class,
        PostsRepositoryServiceProvider::class,
    ];
}
