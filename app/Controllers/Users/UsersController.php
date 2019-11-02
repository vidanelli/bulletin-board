<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Controllers\Users;

use BulletinBoardProject\Models\Users\{Users, UserPageComments};
use BulletinBoardProject\Models\Posts\Posts;
use BulletinBoardProject\Models\Assets\Assets;
use BulletinBoardProject\Repositories\Users\UsersRepository;

class UsersController extends ControllerBase
{
    /**
     * @param int $userId
     */
    public function showAction($userId)
    {
        $user = $this->modelsManager
            ->createBuilder()
            ->from(Users::class)
            ->where('id = :id:', ['id' => $userId])
            ->andWhere('active = 1')
            ->getQuery()
            ->execute()
            ->getFirst();

        $userPageComments = $this->modelsManager
            ->createBuilder()
            ->from(UserPageComments::class)
            ->where('user_page_id = :user_page_id:', ['user_page_id' => $userId])
            ->getQuery()
            ->execute();

        $userAverageRating = $this->getAverageRating($userPageComments);

        $this->view->setVars([
            'User' => $user,
            'Comments' => $userPageComments,
            'userAverageRating' => $userAverageRating
        ]);

        return $this->view->render('users', 'show');
    }

    public function loginAction()
    {
        $success = false;

        if ($this->request->isAjax() && $this->request->isPost()) {
            $user = $this->request->getPost('userData');
            $rememberMe = $this->request->getPost('rememberMe');

            $result = $this->auth->login(
                $user['email'],
                $user['password'],
                $rememberMe);

            if ($result) {
                $success = true;
            }

            $this->response->setJsonContent([
                'success' => $success,
            ]);

            return false;
        }

        return $this->view->render('users', 'login');
    }

    public function signUpAction()
    {
        if ($this->request->isAjax() && $this->request->isPost()) {
            $checkUser = $this->checkEmail($this->request->getPost('email'));
            $rememberMe = $this->request->getPost('rememberMe');

            if (!$checkUser) {
                $user = new Users();
                $user->setFirstName($this->request->getPost('name'))
                    ->setEmail($this->request->getPost('email'))
                    ->setPassword($this->security->hash($this->request->getPost('password')))
                    ->setIp($this->request->getClientAddress())
                    ->save();

                $this->auth->authenticate($user, $rememberMe);

                $this->response->setJsonContent([
                    'success' => true
                ]);
            } else {
                $this->response->setJsonContent([
                    'success' => false,
                    'errorMessage' => 'Пользователь с таким email уже зарегестрирован!'
                ]);
            }

            return false;
        }

        return $this->view->render('users', 'signUp');
    }

    public function logoutAction()
    {
        $this->auth->logout();

        $this->response->redirect('/');

        return false;
    }

    public function changePasswordAction()
    {
        $success = false;

        if ($this->request->isAjax() && $this->request->isPost()) {
            $userId = $this->request->getPost('userId');

            if ($user && $this->security->checkHash($this->request->getPost('oldPassword'), $user->getPassword())) {
                $success = true;

                $user->setPassword($this->security->hash($this->request->getPost('newPassword')))
                    ->save();
            }

            $this->response->setJsonContent([
                'success' => $success,
            ]);

            return false;
        }

        return $this->view->render('users', 'changePassword');
    }

    public function profileAction()
    {
        if ($this->request->isAjax() && $this->request->isPost()) {
            $userId = $this->request->getPost('userId');
            $user = (new UsersRepository())->findById($userId);

            $userAvatar = $user->getUserAvatar();

            if ($this->request->getUploadedFiles()) {
                foreach ($this->request->getUploadedFiles() as $uploadedFile) {
                    $file = $uploadedFile;
                }

                if ($userAvatar) {
                    $this->filesystem->delete('storage://' . $userAvatar->getPath() . $userAvatar->getName());

                    $userAsset = Assets::findFirstById($user->getAvatar());
                }

                $this->resizeUploadAvatar($file->getTempName());

                $stream = fopen($file->getTempName(), 'r+');
                $this->filesystem->writeStream('storage://'."users/{$userId}/".$file->getName(), $stream);
                fclose($stream);

                $asset = $userAsset ?? new Assets();
                $asset->setName($file->getName())
                    ->setPath("users/{$userId}/")
                    ->save();

                $user->setAvatar($asset->getId());
            } elseif (!$this->request->getPost('avatar') && $userAvatar) {
                $userAsset = Assets::findFirstById($user->getAvatar());

                $userAsset->delete();
            }

            $user->setFirstName($this->request->getPost('name'))
                ->setLastName($this->request->getPost('surename'))
                ->setGender($this->request->getPost('gender'))
                ->setBirthday($this->request->getPost('birthday'))
                ->setLocation($this->request->getPost('location'))
                ->setAboutMe($this->request->getPost('aboutMe'))
                ->save();//var_dump($this->request->getPost('aboutMe'));exit;

            if ($user->getUserAvatar()) {
                $this->response->setJsonContent([
                    'avatar' => $user->getUserAvatar()->getSrc()
                ]);
            }

            return false;
        }

        return $this->view->render('users', 'profile');
    }

    /**
     * @param UserPageComments $userPageComments
     * @return int
     */
    protected function getAverageRating($userPageComments): int
    {
        $userRating = $count = 0;

        foreach ($userPageComments as $userPageComment) {
            if ($userPageComment->rating > 0) {
                $userRating += $userPageComment->rating;
                $count++;
            }
        }

        return (int) $userAverageRating = round($userRating/$count);
    }

    /**
     * @param string $email
     * @return Users|null
     */
    protected function checkEmail(string $email): ?Users
    {
        $user = $this->modelsManager
            ->createBuilder()
            ->from(Users::class)
            ->where('email = :email:', ['email' => $email])
            ->getQuery()
            ->execute()
            ->getFirst();

        if ($user) {
            return $user;
        }

        return null;
    }

    /**
     * @param string $file
     * @return void
     */
    protected function resizeUploadAvatar($file): void
    {
        $img = $this->imagemanager->make($file);

        if ($img->width() > 300) {
            if ($img->height() >= $img->width()) {
                $img->resize(null, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->resizeCanvas(300, 300)
                    ->save();
            } else {
                $img->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->resizeCanvas(300, 300)
                    ->save();
            }
        }
    }
}
