<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Listeners;

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
    public function getDI()
    {
        return $this->di;
    }

    /**
     * @param DiInterface $dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector)
    {
        $this->di = $dependencyInjector;
    }

}
