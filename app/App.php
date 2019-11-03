<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject;

use Dotenv\Dotenv;
use Phalcon\Config\Adapter\Php;
use Phalcon\{Di, DiInterface};
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Http\Response;
use BulletinBoardProject\System\Exception\HttpExceptionInterface;

class App
{
    /**
     * @var DiInterface
     */
    protected $dependencyInjector;

    /**
     * @var Application
     */
    protected $app;

    /**
     * Application constructor.
     */
    public function __construct()
    {

        (Dotenv::create(BASE_PATH))->load();

        $this->dependencyInjector = new FactoryDefault();
        $this->app = new Application();

    }

    /**
     * @return \Phalcon\Http\ResponseInterface|bool
     * @throws \Throwable
     */
    public function handle()
    {
        try {

            $response = $this->bootstrap()->handle();

        } catch (\Throwable $throwable) {
            $response = new Response();

            $response->setStatusCode(503);

            if ($throwable instanceof HttpExceptionInterface) {
                $response->setStatusCode($throwable->getStatusCode());

                if ($throwable->hasHeaders()) {
                    $response->setHeaders($throwable->getHeaders());
                }
            }

            echo $throwable->getMessage() . '<br>';
            echo '<pre>' . $throwable->getTraceAsString() . '</pre>';
        }

        $response->send();

        return $response;
    }

    /**
     * @return Application $app
     */
    public function bootstrap(): Application
    {
        $this->registerServices()
            ->registerListeners();

        Di::setDefault($this->dependencyInjector);

        $this->app->setDI($this->dependencyInjector);

        $this->app->setEventsManager($this->dependencyInjector->get('eventsManager'));
        /**
         * @var \BulletinBoardProject\ServiceComponents\ComponentsManager $components
         */
        $components = $this->dependencyInjector
            ->get('componentsManager')
            ->register();

        return $this->app;
    }

    /**
     * @return App
     */
    protected function registerListeners(): App
    {
        $events = new Php(BASE_PATH . '/config/events.php');

        foreach ($events as $eventType => $eventClass) {
            $this->dependencyInjector->get('eventsManager')->attach($eventType, new $eventClass($this->dependencyInjector));
        }

        return $this;
    }

    /**
     * @return App
     */
    protected function registerServices(): App
    {
        $providers = new Php(BASE_PATH . '/config/providers.php');

        foreach ($providers as $provider) {
            $this->dependencyInjector->register(new $provider);
        }

        return $this;
    }

}
