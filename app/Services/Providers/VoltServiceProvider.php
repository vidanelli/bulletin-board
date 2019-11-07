<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Services\Providers;

use App\Core\Di\ServiceProvider;
use Phalcon\DiInterface;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\ViewBaseInterface;

class VoltServiceProvider extends ServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'volt';

    /**
     * Register application service.
     *
     * @param DiInterface $di
     * @return void
     */
    public function register(\Phalcon\DiInterface $di): void
    {
        $di->set($this->name,
            function (ViewBaseInterface $view, DiInterface $di) {
                /** @var \Phalcon\DiInterface $this */

                $config = $this->get('config')->view;

                $volt = new Volt($view, $di);

                $volt->setOptions([
                        'compiledPath' => $config->volt->compiledPath,
                        'compiledSeparator' => $config->volt->compiledSeparator,
                        'compiledExtension' => $config->volt->compiledExtension,
                        'compileAlways' => $config->volt->compileAlways,
                    ]
                );

                return $volt;
            }, false
        );
    }
}
