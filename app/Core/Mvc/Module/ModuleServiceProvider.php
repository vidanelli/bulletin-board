<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Core\Mvc\Module;

use Phalcon\Di\ServiceProviderInterface;

abstract class ModuleServiceProvider implements ServiceProviderInterface
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
