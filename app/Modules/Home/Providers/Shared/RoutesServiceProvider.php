<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Home\Providers\Shared;

use App\Modules\Home\Routes\HomeRoutes;
use App\Core\Di\ServiceProvider;

class RoutesServiceProvider extends ServiceProvider
{
    public function register(\Phalcon\DiInterface $di)
    {
        $di->get('router')->mount($this->getRoutes());
    }

    protected function getRoutes()
    {
        return new HomeRoutes();
    }
}
