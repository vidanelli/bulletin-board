<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Routes\Posts;

use Phalcon\Mvc\Router\Group;

class PostsRoutes extends Group
{

    public function initialize()
    {
        $this->setPaths([
            'namespace' => 'BulletinBoardProject\Controllers\Posts',
        ]);

        $this->setPrefix('/posts');

        $this->add('/:action', [
            'controller' => 'posts',
            'action' => 1,
        ]);

        $this->add('/([0-9]+)', [
            'controller' => 'posts',
            'action' => 'show',
            'postId' => 1,
        ]);

    }
}
