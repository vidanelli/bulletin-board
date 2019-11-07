<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Posts\Controllers;

use App\Modules\Users\Models\Users;
use App\Modules\Posts\Models\Posts;
use App\Modules\Assets\Models\Assets;

class PostsController extends ControllerBase
{
    /**
     * @param int $postId
     */
    public function showAction($postId)
    {
        $this->view->setVar(
            'Post', Posts::findFirst($postId)
        );
    }

    public function createAction()
    {
        return $this->view->render('posts', 'create');
    }

    public function saveAction()
    {
        $success = false;

        if ($this->request->isAjax() && $this->request->isPost()) {
            $post = $this->request->getPost('postData');
            $userId = $this->request->getPost('userId');

            if ($this->request->getUploadedFiles()) {
                $success = true;

                foreach ($this->request->getUploadedFiles() as $uploadedFile) {
                    $file = $uploadedFile;
                }

                $asset = new Assets();
                $asset->setName($file->getName())
                    ->save();

                $post = new Posts($post);
                $post->setImageId($asset->getId())
                    ->save();

                $asset->refresh()
                    ->setPath("posts/{$post->getId()}/")
                    ->save();

                $img = $this->imagemanager->make($file->getTempName());
                $img->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save();

                $stream = fopen($file->getTempName(), 'r+');
                $this->filesystem->writeStream('storage://'."posts/{$post->getId()}/".$file->getName(), $stream);
                fclose($stream);
            }

            $this->response->setJsonContent([
                'success' => $success,
            ]);
        }

        return false;
    }
}
