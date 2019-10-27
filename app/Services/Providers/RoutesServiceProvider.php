<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use BulletinBoardProject\Routes\Routes;
use Phalcon\Di\ServiceProviderInterface;

class RoutesServiceProvider implements ServiceProviderInterface
{
    public function register(\Phalcon\DiInterface $di)
    {
        $di->get('router')->mount($this->getRoutes());
    }

    protected function getRoutes()
    {
        return new Routes();
    }
}
