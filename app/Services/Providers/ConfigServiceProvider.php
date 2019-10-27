<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Config;
use Phalcon\Config\Adapter\Php;
use function BulletinBoardProject\Helpers\configPath;

class ConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'config';

    /**
     * @var array
     */
    private $configs = [
        'application',
        'components',
        'database',
        'session',
        'view',
    ];

    /**
     * Register application service.
     *
     * @param \Phalcon\DiInterface $di
     * @return void
     */
    public function register(\Phalcon\DiInterface $di): void
    {
        $config = $this->loadConfig();

        $di->setShared($this->name,
            function () use ($config) {
                /** @var \Phalcon\DiInterface $this */
                return $config;
            }
        );
    }

    /**
     * @return Config
     */
    public function loadConfig(): Config
    {
        $generalConfig = new Config([]);

        foreach ($this->configs as $config) {
            $configObject = new Php(configPath($config) . '.php');
            $generalConfig->merge($configObject);
        }

        return $generalConfig;
    }

}
