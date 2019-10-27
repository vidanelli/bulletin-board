<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
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
