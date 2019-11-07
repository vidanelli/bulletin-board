<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Services\Providers;

use App\Core\Di\ServiceProvider;
use Phalcon\Http\Response\Cookies;

class CookiesServiceProvider extends ServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'cookies';

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

                $cookies = new Cookies();
                $cookies->useEncryption(true);

                return $cookies;
            }
        );
    }
}
