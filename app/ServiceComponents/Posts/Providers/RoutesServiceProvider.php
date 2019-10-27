<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\ServiceComponents\Posts\Providers;

use BulletinBoardProject\Routes\Posts\PostsRoutes;
use Phalcon\Di\ServiceProviderInterface;

class RoutesServiceProvider implements ServiceProviderInterface
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
