<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Users\Providers\Shared;

use App\Modules\Users\Repositories\UsersRepository;
use App\Core\Di\ServiceProvider;

class UsersRepositoryServiceProvider extends ServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'usersRepository';

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
                $repository = new UsersRepository();

                return $repository;
            }
        );
    }
}
