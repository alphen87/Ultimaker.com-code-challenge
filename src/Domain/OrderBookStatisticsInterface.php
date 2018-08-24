<?php

namespace Ultimaker\Challenge\Domain;

interface OrderBookStatisticsInterface
{
    /**
     * @return int
     */
    public function getTotalBuyOrders(): int;

    /**
     * @return int
     */
    public function getTotalSellOrders(): int;

    /**
     * @return float
     */
    public function getAvgBuyPrice(): float;

    /**
     * @return float
     */
    public function getAvgSellPrice(): float;

}