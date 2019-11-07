<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Posts\Providers\Shared;

use App\Modules\Posts\Repositories\PostsRepository;
use App\Core\Di\ServiceProvider;

class PostsRepositoryServiceProvider extends ServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'postsRepository';

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
                $repository = new PostsRepository();

                return $repository;
            }
        );
    }
}
