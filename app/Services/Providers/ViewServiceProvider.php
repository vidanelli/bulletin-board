<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Services\Providers;

use App\Core\Di\ServiceProvider;
use Phalcon\Mvc\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'view';

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

                $config = $this->get('config')->view;
                $view = new View();

                $view->registerEngines([
                    '.volt' => $this->get('volt', [$view, $this])
                ]);

                $view->setViewsDir($config->dir)
                    ->setEventsManager($this->get('eventsManager'));

                return $view;
            }
        );
    }
}
