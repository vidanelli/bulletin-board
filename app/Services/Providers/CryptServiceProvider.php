<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Crypt;
use function BulletinBoardProject\Helpers\env;

class CryptServiceProvider implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'crypt';

    /**
     * Register application service.
     *
     * @param \Phalcon\DiInterface $di
     * @return void
     */
    public function register(\Phalcon\DiInterface $di)
    {
        $di->setShared($this->name,
            function () {
                /** @var \Phalcon\DiInterface $this */

                $crypt = new Crypt();
                $crypt->setKey(env('APP_KEY'));
                return $crypt;
            }
        );
    }

}
