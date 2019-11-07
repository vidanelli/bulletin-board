<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Services\Providers;

use App\Core\Di\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
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
    }
}
