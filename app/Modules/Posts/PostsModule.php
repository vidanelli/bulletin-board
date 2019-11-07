<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Posts;

use App\Core\Mvc\Module;
use Phalcon\DiInterface;

class PostsModule extends Module
{

    protected $providers = [
        //UsersServiceProvider::class,
    ];

    /**
     * Register specific services for the module.
     */
    public function registerServices(DiInterface $di = null)
    {
        $di->get('dispatcher')
            ->setDefaultNamespace('App\Modules\Posts\Controllers');

        $di->get('registrator')->registerProviders($this->providers);
    }

}
