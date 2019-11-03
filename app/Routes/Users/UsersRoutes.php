<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Routes\Users;

use Phalcon\Mvc\Router\Group;
use BulletinBoardProject\Middlewares\Authenticate();

class UsersRoutes extends Group
{

    public function initialize()
    {
        $this->setPaths([
            'namespace' => 'BulletinBoardProject\Controllers\Users',
        ]);

        $this->setPrefix('/users');

        $this->add('/:action', [
            'controller' => 'users',
            'action' => 1,
        ])->beforeMatch(
            [
                new Authenticate(),
                'handle'
            ]
        );

        $this->add('/{userId:[0-9]+}', [
            'controller' => 'users',
            'action' => 'show',
        ]);

        $this->add('/comment/add', [
            'controller' => 'user_page_comments',
            'action' => 'add',
        ]);

        $this->add('/change/password', [
            'controller' => 'users',
            'action' => 'changePassword',
        ])->beforeMatch(
            [
                new Authenticate(),
                'handle'
            ]
        );

    }
}
