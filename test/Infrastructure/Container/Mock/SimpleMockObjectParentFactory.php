<?php

namespace UltimakerTest\Challenge\Infrastructure\Container\Mock;

use Psr\Container\ContainerInterface;
use Ultimaker\Challenge\Infrastructure\Container\FactoryInterface;

class SimpleMockObjectParentFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $id
     * @return SimpleMockObjectParent
     */
    public function __invoke(ContainerInterface $container, string $id): SimpleMockObjectParent
    {
        /** @var SimpleMockObject $child */
        $child = $container->get(SimpleMockObject::class);
        return new SimpleMockObjectParent($child);
    }
}