<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\ServiceComponents\Users;

use BulletinBoardProject\ServiceComponents\Users\Providers\AuthServiceProvider;
use BulletinBoardProject\ServiceComponents\Users\Providers\RoutesServiceProvider;
use BulletinBoardProject\ServiceComponents\ComponentsProvider;

class UsersComponentProvider extends ComponentsProvider
{
    protected $providers = [
        AuthServiceProvider::class,
        RoutesServiceProvider::class,
    ];
}
