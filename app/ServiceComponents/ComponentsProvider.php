<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\ServiceComponents;

use Phalcon\Di\ServiceProviderInterface;
use BulletinBoardProject\Routes\Routes;

abstract class ComponentsProvider implements ServiceProviderInterface
{
    /**
     * @var ServiceProviderInterface[]
     */
    protected $providers = [];

    /**
     * @param \Phalcon\DiInterface $di
     */
    public function register(\Phalcon\DiInterface $di)
    {
        $di->get('registrator')->registerProviders($this->providers);
    }
}
