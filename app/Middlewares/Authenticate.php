<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Middlewares;

use Phalcon\Http\RequestInterface;
use BulletinBoardProject\System\Exception\UnauthorizedException;
use BulletinBoardProject\Middlewares\Traits\IsExclude;

class Authenticate
{
    use IsExclude;

    /**
     * @var array
     */
    protected $exclude = [
        '/users/login',
        '/users/signup',
    ];

    public function handle($uri, $route, $router)
    {
        $auth = $router->getDi()->get('auth');

        if ($this->isExclude($uri) || $auth->getLoggedUser()) {
            return true;
        }

        return $router->getDi()->get('response')->redirect('/users/login');
    }
}
