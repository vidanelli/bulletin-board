<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

use BulletinBoardProject\Models\Posts;
use BulletinBoardProject\Repositories\PagesRepository;

class PagesController extends ControllerBase
{
    /**
     * @param int $postId
     */
    public function showAction($postId)
    {
        $this->view->setVar(
            'Post', (new PagesRepository())->fetchById($postId)
        );
    }
}
