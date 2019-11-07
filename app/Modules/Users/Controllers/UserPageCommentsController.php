<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Users\Controllers;

use App\Modules\Users\Models\{Users, UserPageComments};
use App\Modules\Posts\Models\Posts;

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
