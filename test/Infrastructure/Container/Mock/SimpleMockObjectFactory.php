<?php

namespace UltimakerTest\Challenge\Infrastructure\Container\Mock;

use Psr\Container\ContainerInterface;
use Ultimaker\Challenge\Infrastructure\Container\FactoryInterface;

class SimpleMockObjectFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $id
     * @return SimpleMockObject
     */
    public function __invoke(ContainerInterface $container, string $id): SimpleMockObject
    {
        return new SimpleMockObject();
    }
}