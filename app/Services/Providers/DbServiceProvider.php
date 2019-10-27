<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Model;
use Phalcon\Db\Adapter\Pdo\Factory;

class DbServiceProvider implements ServiceProviderInterface
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
