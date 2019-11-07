<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Users\Providers\Shared;

use App\Modules\Users\Routes\UsersRoutes;
use App\Core\Di\ServiceProvider;

class RoutesServiceProvider extends ServiceProvider
{
    public function register(\Phalcon\DiInterface $di)
    {
        $di->get('router')->mount($this->getRoutes());
    }

    protected function getRoutes()
    {
        return new UsersRoutes();
    }
}
