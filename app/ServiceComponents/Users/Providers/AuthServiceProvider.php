<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\ServiceComponents\Users\Providers;

use BulletinBoardProject\ServiceComponents\Users\Services\{AuthService, TokenService};
use Phalcon\Di\ServiceProviderInterface;

class AuthServiceProvider implements ServiceProviderInterface
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
