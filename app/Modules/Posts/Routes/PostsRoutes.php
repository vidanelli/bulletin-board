<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Posts\Routes;

use Phalcon\Mvc\Router\Group;

class PostsRoutes extends Group
{

    public function initialize()
    {
        $this->setPaths([
            'module' => 'Posts',
            'namespace' => 'App\Modules\Posts\Controllers',
        ]);

        $this->setPrefix('/posts');

        $this->add('/:action', [
            'controller' => 'posts',
            'action' => 1,
        ]);

        $this->add('/{postId:[0-9]+}', [
            'controller' => 'posts',
            'action' => 'show',
        ]);

    }
}
