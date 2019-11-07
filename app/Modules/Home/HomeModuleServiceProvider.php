<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Home;

use App\Core\Mvc\Module\ModuleServiceProvider;
use App\Modules\Home\Providers\Shared\RoutesServiceProvider;

class HomeModuleServiceProvider extends ModuleServiceProvider
{
    protected $providers = [
        RoutesServiceProvider::class,
    ];
}
