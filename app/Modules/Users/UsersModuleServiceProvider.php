<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Users;

use App\Core\Mvc\Module\ModuleServiceProvider;
use App\Modules\Users\Providers\Shared\{
    AuthServiceProvider,
    RoutesServiceProvider,
    UsersRepositoryServiceProvider,
};

class UsersModuleServiceProvider extends ModuleServiceProvider
{
    protected $providers = [
        AuthServiceProvider::class,
        RoutesServiceProvider::class,
        UsersRepositoryServiceProvider::class,
    ];
}
