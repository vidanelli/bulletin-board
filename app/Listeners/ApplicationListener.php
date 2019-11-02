<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Listeners;

use BulletinBoardProject\Middlewares\VerifyCsrf;
use Phalcon\Application;
use Phalcon\Events\EventInterface;

class ApplicationListener extends Listener
{

    /**
     * The application's middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        VerifyCsrf::class,
    ];

    /**
     * @param EventInterface $event
     * @param Application $application
     * @return bool
     */
    public function boot(EventInterface $event, Application $application): bool
    {
        foreach ($this->middleware as $handler) {
            $status = (new $handler)->execute($application->getDI()->get('request'));

            if ($status === false) {
                return false;
            }
        }

        return true;
    }

}
