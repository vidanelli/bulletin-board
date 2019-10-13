<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

use BulletinBoardProject\Models\{Users, Posts, UserPageComments};

class UserPageCommentsController extends ControllerBase
{
    /**
     * Add new comment
     */
    public function addAction()
    {
        $success = false;

        if ($this->request->isAjax() && $this->request->isPost()) {
            $comment = $this->request->getPost('commentData');
            $userId = $this->request->getPost('userId');

            $userPageComment = new UserPageComments($comment);
            $userPageComment->setUserPageId($userId)
                ->setCreatedAt($this->datetime->now()->toDateTimeString())
                ->save();

            $userPageComment->refresh();

            $success = true;
        }

        $this->response->setJsonContent([
            'success' => $success,
        ]);

        return false;
    }
}
