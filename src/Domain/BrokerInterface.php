<?php

namespace Ultimaker\Challenge\Domain;

interface BrokerInterface
{
    /**
     * @param StockInterface $stock
     * @param float $price
     * @param int $quantity
     * @throws Exception\InvalidArgumentException
     */
    public function buy(StockInterface $stock, float $price, int $quantity);

    /**
     * @param StockInterface $stock
     * @param float $price
     * @param int $quantity
     * @throws Exception\InvalidArgumentException
     */
    public function sell(StockInterface $stock, float $price, int $quantity);

    /**
     * @param StockInterface $stock
     * @return int
     */
    public function getTotalOrderCount(StockInterface $stock): int;

    /**
     * @param StockInterface $stock
     * @return int
     */
    public function getBuyOrderCount(StockInterface $stock): int;

    /**
     * @param StockInterface $stock
     * @return int
     */
    public function getSellOrderCount(StockInterface $stock): int;

    /**
     * @param StockInterface $stock
     * @return float
     */
    public function getAvgBuyPrice(StockInterface $stock): float;

    /**
     * @param StockInterface $stock
     * @return float
     */
    public function getAvgSellPrice(StockInterface $stock): float;

    /**
     * Represent order statistics as array for all stock this broker manages
     * @return array
     */
    public function toArray(): array;
}