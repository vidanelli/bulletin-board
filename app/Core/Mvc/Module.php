<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Core\Mvc;

use Phalcon\Mvc\ModuleDefinitionInterface;

abstract class Module implements ModuleDefinitionInterface
{
    /**
     * @var \Phalcon\Di\ServiceProviderInterface[]
     */
    protected $providers = [];

    /**
     * @param \Phalcon\DiInterface|null $dependencyInjector
     */
    public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = null)
    {
    }

    /**
     * @param \Phalcon\DiInterface $dependencyInjector
     * @return mixed
     */
    abstract public function registerServices(\Phalcon\DiInterface $dependencyInjector);

}
