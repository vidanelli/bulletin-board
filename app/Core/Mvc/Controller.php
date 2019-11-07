<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Core\Mvc;

use Phalcon\Mvc\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Controller constructor
     */
    public function initialize()
    {
        $user = $this->auth->getLoggedUser();

        $this->view->setVar('LoggedUser', $user);
    }
}
