<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Services\Providers;

use App\Core\Di\ServiceProvider;
use Phalcon\Mvc\Model;
use Phalcon\Db\Adapter\Pdo\Factory;

class DbServiceProvider extends ServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'db';

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

                $config = $this->get('config')->database;

                $driver = $config->drivers->{$config->driver};

                /** @var \Phalcon\Db\Adapter\Pdo $connection */
                $connection = Factory::load($driver);

                return $connection;
            }
        );

        $this->setupModelOptions();
    }

    /**
     * @return void
     */
    protected function setupModelOptions(): void
    {
        Model::setup([
            'exceptionOnFailedSave' => true,
        ]);
    }
}
