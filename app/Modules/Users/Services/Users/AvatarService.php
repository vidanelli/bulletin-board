<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Users\Services\Users;

use App\Modules\Users\Models\UserInterface;
use Phalcon\Di\Injectable;
use Phalcon\Http\Request\File;
use App\Modules\Assets\Models\Assets;

class AvatarService extends Injectable
{
    /**
     * @param UserInterface $user
     * @param File $files
     * @return void
     */
    public function save(UserInterface $user, File $file): void
    {
        $userAvatar = $user->getUserAvatar();

        if ($userAvatar) {
            $this->filesystem->delete('storage://'.$userAvatar->getPath().$userAvatar->getName());

            $userAsset = Assets::findFirstById($user->getAvatar());
        }

        $this->resizeUploadAvatar($file->getTempName());

        $stream = fopen($file->getTempName(), 'r+');
        $this->filesystem->writeStream('storage://'."users/{$user->getId()}/".$file->getName(), $stream);
        fclose($stream);

        $asset = $userAsset ?? new Assets();
        $asset->setName($file->getName())
            ->setPath("users/{$user->getId()}/")
            ->save();

        $user->setAvatar($asset->getId());
    }

    /**
     * @param UserInterface $user
     * @return void
     */
    public function delete(UserInterface $user): void
    {
        Assets::findFirstById($user->getAvatar())->delete();

        $user->setAvatar(0);
    }

    /**
     * @param string $file
     * @return void
     */
    protected function resizeUploadAvatar(string $file): void
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
