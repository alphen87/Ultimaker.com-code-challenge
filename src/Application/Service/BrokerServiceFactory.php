<?php

namespace Ultimaker\Challenge\Application\Service;

use Psr\Container\ContainerInterface;
use Ultimaker\Challenge\Domain\Broker;
use Ultimaker\Challenge\Domain\StockRepositoryInterface;
use Ultimaker\Challenge\Infrastructure\Container\FactoryInterface;

class BrokerServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $id
     * @return BrokerServiceInterface
     */
    public function __invoke(ContainerInterface $container, string $id): BrokerServiceInterface
    {
        $stockRepository = $container->get(StockRepositoryInterface::class);
        return new BrokerService(new Broker(), $stockRepository);
    }
}