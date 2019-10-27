<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\ServiceComponents;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\DiInterface;

class ComponentsManager implements InjectionAwareInterface
{
    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * @var array
     */
    private $components;

    /**
     * ComponentsManager constructor.
     * @param array $components
     */
    public function __construct(array $components)
    {
        $this->components = $components;
    }

    /**
     * @return ComponentsManager
     */
    public function register(): ComponentsManager
    {
        foreach ($this->components as $component) {
            $this->di->register(new $component['provider']);
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
    public function getComponents(): array
    {
        return $this->components;
    }

}
