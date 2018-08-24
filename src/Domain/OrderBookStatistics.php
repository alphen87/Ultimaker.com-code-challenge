<?php

namespace Ultimaker\Challenge\Domain;

class OrderBookStatistics implements OrderBookStatisticsInterface
{
    /**
     * @var int
     */
    protected $totalBuyOrders;

    /**
     * @var int
     */
    protected $totalSellOrders;

    /**
     * @var float
     */
    protected $avgBuyPrice;

    /**
     * @var float
     */
    protected $avgSellPrice;

    /**
     * OrderBookStatistics constructor.
     * @param int $totalBuyOrders
     * @param int $totalSellOrders
     * @param float $avgBuyPrice
     * @param float $avgSellPrice
     */
    public function __construct(int $totalBuyOrders, int $totalSellOrders, float $avgBuyPrice, float $avgSellPrice)
    {
        $this->totalBuyOrders = $totalBuyOrders;
        $this->totalSellOrders = $totalSellOrders;
        $this->avgBuyPrice = $avgBuyPrice;
        $this->avgSellPrice = $avgSellPrice;
    }

    /**
     * @return int
     */
    public function getTotalBuyOrders(): int
    {
        return $this->totalBuyOrders;
    }

    /**
     * @return int
     */
    public function getTotalSellOrders(): int
    {
        return $this->totalSellOrders;
    }

    /**
     * @return float
     */
    public function getAvgBuyPrice(): float
    {
        return $this->avgBuyPrice;
    }

    /**
     * @return float
     */
    public function getAvgSellPrice(): float
    {
        return $this->avgSellPrice;
    }

}