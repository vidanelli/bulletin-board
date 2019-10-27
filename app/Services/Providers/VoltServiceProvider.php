<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\ViewBaseInterface;

class VoltServiceProvider implements ServiceProviderInterface
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
