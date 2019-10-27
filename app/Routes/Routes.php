<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Routes;

use Phalcon\Mvc\Router\Group;

class Routes extends Group
{
    public function initialize()
    {
        $this->add('/', [
            'action' => 'index'
        ]);
    }
}
