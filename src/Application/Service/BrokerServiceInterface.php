<?php

namespace Ultimaker\Challenge\Application\Service;

use Ultimaker\Challenge\Application\Dto\BrokerStatisticsDto;
use Ultimaker\Challenge\Application\Service\Exception\InvalidArgumentException;

interface BrokerServiceInterface
{
    /**
     * @param string $stock
     * @param float $price
     * @param int $quantity
     * @throws InvalidArgumentException
     */
    public function placeBuyOrder(string $stock, float $price, int $quantity): void;

    /**
     * @param string $stock
     * @param float $price
     * @param int $quantity
     * @throws InvalidArgumentException
     */
    public function placeSellOrder(string $stock, float $price, int $quantity): void;

    /**
     * @return BrokerStatisticsDto
     */
    public function getBrokerStatistics(): BrokerStatisticsDto;
}