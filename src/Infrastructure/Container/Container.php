<?php

namespace Ultimaker\Challenge\Infrastructure\Container;

use Psr\Container\ContainerInterface;

/**
 * Simple container with support for factories
 * @package Ultimaker\Challenge\Container
 */
class Container implements ContainerInterface
{
    /**
     * @var array<string, FactoryInterface>
     */
    private $factories = [];

    /**
     * Cached instances
     * @var array
     */
    private $instances = [];

    /**
     * @param string $id
     * @return mixed
     * @throws NotFoundException
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException($id);
        }

        if(!isset($this->instances[$id])){
            $factory = $this->factories[$id];
            $this->instances[$id] = $factory($this, $id);
        }

        return $this->instances[$id];
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has($id): bool
    {
        return (array_key_exists($id, $this->factories));
    }

    /**
     * @param string $id
     * @param string $factoryClass
     * @throws InvalidArgumentException
     */
    public function set(string $id, string $factoryClass): void
    {
        if(
            class_exists($factoryClass) &&
            is_subclass_of($factoryClass, FactoryInterface::class)
        ){
            //clear instance for id if it already exists
            if(isset($this->instances[$id])){
                unset($this->instances[$id]);
            }

            $this->factories[$id] = new $factoryClass();
        }else{
            throw new InvalidArgumentException($id);
        }
    }
}