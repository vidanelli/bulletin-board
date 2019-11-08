<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Users\Providers;

use App\Modules\Users\Services\Users\AvatarService;
use App\Core\Di\ServiceProvider;

class UserAvatarServiceProvider extends ServiceProvider
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'userAvatar';

    /**
     * Register application service.
     *
     * @return void
     */
    public function register(\Phalcon\DiInterface $di)
    {
        $di->setShared($this->name,
            function () {
                /** @var \Phalcon\DiInterface $this */
                return new AvatarService();
            }
        );
    }
}
