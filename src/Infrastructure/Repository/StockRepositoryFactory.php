<?php

namespace Ultimaker\Challenge\Infrastructure\Repository;

use Psr\Container\ContainerInterface;
use Ultimaker\Challenge\Domain\StockRepositoryInterface;
use Ultimaker\Challenge\Infrastructure\Container\FactoryInterface;

class StockRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $id
     * @return StaticStockRepository
     */
    public function __invoke(ContainerInterface $container, string $id): StockRepositoryInterface
    {
        return new StaticStockRepository();
    }
}