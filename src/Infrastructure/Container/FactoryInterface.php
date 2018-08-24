<?php

namespace Ultimaker\Challenge\Infrastructure\Container;

use Psr\Container\ContainerInterface;

interface FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $id identifier used to query the container, in case you want to support multiple outputs
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, string $id);
}