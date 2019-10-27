<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\System\Di;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;

class Registrator implements InjectionAwareInterface
{
    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * @param ServiceProviderInterface[] $providers
     * @return void
     */
    public function registerProviders(array $providers): void
    {
        foreach ($providers as $provider) {
            $this->di->register(new $provider);
        }
    }

    /**
     * @return DiInterface
     */
    public function getDi(): DiInterface
    {
        return $this->di;
    }

    /**
     * @param DiInterface $di
     * @return void
     */
    public function setDi(DiInterface $di): void
    {
        $this->di = $di;
    }

}
