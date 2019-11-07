<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Home\Routes;

use Phalcon\Mvc\Router\Group;

class HomeRoutes extends Group
{
    public function initialize()
    {
        $this->add('/', [
            'action' => 'index'
        ]);
    }
}
