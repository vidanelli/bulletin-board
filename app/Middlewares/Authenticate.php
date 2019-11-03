<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Middlewares;

use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\RouterInterface;
use Phalcon\Mvc\Router\RouteInterface;
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

    /**
     * @param string $uri
     * @param RouteInterface $route
     * @param RouterInterface $router
     * @return ResponseInterface|bool
     */
    public function handle(string $uri, RouteInterface $route, RouterInterface $router)
    {
        $auth = $router->getDi()->get('auth');

        if ($this->isExclude($uri) || $auth->getLoggedUser()) {
            return true;
        }

        return $router->getDi()->get('response')->redirect('/users/login');
    }
}
