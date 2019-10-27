<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\ServiceComponents\Users\Providers;

use BulletinBoardProject\Routes\Users\UsersRoutes;
use Phalcon\Di\ServiceProviderInterface;

class RoutesServiceProvider implements ServiceProviderInterface
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
