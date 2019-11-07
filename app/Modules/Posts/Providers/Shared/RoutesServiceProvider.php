<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Posts\Providers\Shared;

use App\Modules\Posts\Routes\PostsRoutes;
use App\Core\Di\ServiceProvider;

class RoutesServiceProvider extends ServiceProvider
{
    public function register(\Phalcon\DiInterface $di)
    {
        $di->get('router')->mount($this->getRoutes());
    }

    protected function getRoutes()
    {
        return new PostsRoutes();
    }
}
