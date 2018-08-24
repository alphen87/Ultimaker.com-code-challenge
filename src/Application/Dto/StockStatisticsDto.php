<?php

namespace Ultimaker\Challenge\Application\Dto;

class StockStatisticsDto
{
    /**
     * @var string
     */
    public $stock;
    /**
     * @var float
     */
    public $avgBuyPrice;
    /**
     * @var float
     */
    public $avgSellPrice;
    /**
     * @var int
     */
    public $sellOrdersAmount;
    /**
     * @var int
     */
    public $buyOrdersAmount;
    /**
     * @var int
     */
    public $ordersAmount;
}