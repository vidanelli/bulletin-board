<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use BulletinBoardProject\System\Di\Registrator;
use Phalcon\Di\ServiceProviderInterface;

class RegistratorServiceProvider implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'registrator';

    /**
     * Register application service.
     *
     * @param \Phalcon\DiInterface $di
     * @return void
     */
    public function register(\Phalcon\DiInterface $di): void
    {
        $di->setShared($this->name,
            function () {
                /** @var \Phalcon\DiInterface $this */

                return new Registrator();
            }
        );
    }
}
