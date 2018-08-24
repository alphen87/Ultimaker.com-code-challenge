<?php

return [
    \Ultimaker\Challenge\Domain\StockRepositoryInterface::class => \Ultimaker\Challenge\Infrastructure\Repository\StockRepositoryFactory::class,
    \Ultimaker\Challenge\Application\Service\BrokerServiceInterface::class => \Ultimaker\Challenge\Application\Service\BrokerServiceFactory::class
];