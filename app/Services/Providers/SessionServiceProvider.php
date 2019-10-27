<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use Phalcon\Di\ServiceProviderInterface;

class SessionServiceProvider implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'session';

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
                $config = $this->get('config')->session;
                $driver = $config->drivers->{$config->default};
                $adapter = '\Phalcon\Session\Adapter\\' . $driver->adapter;
                $defaults = [
                    'prefix' => $config->prefix,
                    'uniqueId' => $config->uniqueId,
                    'lifetime' => $config->lifetime,
                ];

                /** @var \Phalcon\Session\AdapterInterface $session */
                $session = new $adapter(array_merge($driver->toArray(), $defaults));
                $session->start();

                return $session;
            }
        );

        //$di->get($this->name)->start();
    }
}
