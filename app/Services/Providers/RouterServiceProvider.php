<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Services\Providers;

use App\Core\Di\ServiceProvider;
use Phalcon\Mvc\Router;

class RouterServiceProvider extends ServiceProvider
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
                    ->setDefaultModule('Home')
                    ->setDefaultController('index')
                    ->setEventsManager($this->get('eventsManager'));

                return $router;
            }
        );
    }
}
