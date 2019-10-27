<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Router;

class RouterServiceProvider implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'router';

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
                $router = new Router(false);

                $router->notFound([
                    'action' => 'notFound'
                ]);

                $router->removeExtraSlashes(true)
                    ->setDefaultNamespace('BulletinBoardProject\Controllers')
                    ->setDefaultController('index')
                    ->setEventsManager($this->get('eventsManager'));

                return $router;
            }
        );
    }
}
