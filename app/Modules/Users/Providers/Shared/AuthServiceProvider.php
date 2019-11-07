<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Users\Providers\Shared;

use App\Modules\Users\Services\{AuthService, TokenService};
use App\Core\Di\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'auth';

    /**
     * Register application service.
     *
     * @return void
     */
    public function register(\Phalcon\DiInterface $di)
    {
        $di->setShared($this->name,
            function () {
                /** @var \Phalcon\DiInterface $this */
                $auth = new AuthService(new TokenService());

                return $auth;
            }
        );
    }
}
