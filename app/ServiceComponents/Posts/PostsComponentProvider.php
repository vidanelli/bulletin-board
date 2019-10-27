<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\ServiceComponents\Posts;

use BulletinBoardProject\ServiceComponents\Posts\Providers\RoutesServiceProvider;
use BulletinBoardProject\ServiceComponents\ComponentsProvider;

class PostsComponentProvider extends ComponentsProvider
{
    protected $providers = [
        RoutesServiceProvider::class,
    ];
}
