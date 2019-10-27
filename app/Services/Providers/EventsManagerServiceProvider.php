<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Events\Manager;

class EventsManagerServiceProvider implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'eventsManager';

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

                $eventsManager = new Manager();

                return $eventsManager;
            }
        );
    }
}
