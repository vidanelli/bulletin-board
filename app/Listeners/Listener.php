<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Listeners;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\DiInterface;

abstract class Listener implements InjectionAwareInterface
{
    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * @return DiInterface
     */
    public function getDI(): DiInterface
    {
        return $this->di;
    }

    /**
     * @param DiInterface $dependencyInjector
     * @return void
     */
    public function setDI(DiInterface $dependencyInjector): void
    {
        $this->di = $dependencyInjector;
    }

}
