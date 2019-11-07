<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Core\Mvc\Module;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\DiInterface;

class Manager implements InjectionAwareInterface
{
    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * @var array
     */
    private $modules;

    /**
     * Manager constructor.
     * @param array $modules
     */
    public function __construct(array $modules)
    {
        $this->modules = $modules;
    }

    /**
     * @return Manager
     */
    public function register(): Manager
    {
        foreach ($this->modules as $modules) {
            $this->di->register(new $modules['provider']);
        }

        return $this;
    }

    /**
     * @return DiInterface
     */
    public function getDi(): DiInterface
    {
        return $this->di;
    }

    /**
     * @param DiInterface $di
     */
    public function setDi(DiInterface $di)
    {
        $this->di = $di;
    }

    /**
     * @return array
     */
    public function getModules(): array
    {
        return $this->modules;
    }

}
