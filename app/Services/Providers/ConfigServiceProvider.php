<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Services\Providers;

use App\Core\Di\ServiceProvider;
use Phalcon\Config;
use Phalcon\Config\Adapter\Php;
use function App\Helpers\configPath;

class ConfigServiceProvider extends ServiceProvider
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
        'modules',
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
