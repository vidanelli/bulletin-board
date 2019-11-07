<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Core\Di;


use Phalcon\Di\ServiceProviderInterface;

abstract class ServiceProvider implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $name;

    /**
     * Gets the Service name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
