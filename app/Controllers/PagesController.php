<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

use BulletinBoardProject\Models\Posts;

class PagesController extends ControllerBase
{
    /**
     * @param int $postId
     */
    public function showAction($postId)
    {
        $post = $this->modelsManager
            ->createBuilder()
            ->from(Posts::class)
            ->where('id = :id:', ['id' => $postId])
            ->andWhere('active = 1')
            ->andWhere('deleted = 0')
            ->getQuery()
            ->execute()
            ->getFirst();

        $this->view->setVar('Post', $post);
    }
}
