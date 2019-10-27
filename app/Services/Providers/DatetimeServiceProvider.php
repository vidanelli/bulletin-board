<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use Carbon\Carbon;
use Phalcon\Di\ServiceProviderInterface;

class DatetimeServiceProvider implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'datetime';

    /**
     * Register application service.
     *
     * @param \Phalcon\DiInterface $di
     * @return void
     */
    public function register(\Phalcon\DiInterface $di): void
    {
        $di->setShared($this->name,
            function () {
                /** @var \Phalcon\DiInterface $this */

                $carbon = new Carbon();

                return $carbon->set('timezone', $this->get('config')->application->timezone);
            }
        );
    }
}
