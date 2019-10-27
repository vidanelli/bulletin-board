<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Dispatcher;

class DispatcherServiceProvider implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'dispatcher';

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

                $dispatcher = new Dispatcher();
                $dispatcher->setEventsManager($this->get('eventsManager'));

                return $dispatcher;
            }
        );
    }
}
