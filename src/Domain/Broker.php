<?php

namespace Ultimaker\Challenge\Domain;

class Broker implements BrokerInterface
{
    /**
     * @var OrderBookInterface[]
     */
    protected $orderBooks;

    /**
     * @param StockInterface $stock
     * @param float $price
     * @param int $quantity
     * @throws Exception\InvalidArgumentException
     */
    public function buy(StockInterface $stock, float $price, int $quantity)
    {
        $this->getOrderBookForStock($stock)
            ->add(new Order(OrderInterface::TYPE_BUY, $price, $quantity, new \DateTime()));
    }

    /**
     * @param StockInterface $stock
     * @param float $price
     * @param int $quantity
     * @throws Exception\InvalidArgumentException
     */
    public function sell(StockInterface $stock, float $price, int $quantity)
    {
        $this->getOrderBookForStock($stock)
            ->add(new Order(OrderInterface::TYPE_SELL, $price, $quantity, new \DateTime()));
    }

    /**
     * @param StockInterface $stock
     * @return int
     */
    public function getTotalOrderCount(StockInterface $stock): int
    {
        return $this->getOrderBookForStock($stock)->count();
    }

    /**
     * @param StockInterface $stock
     * @return int
     */
    public function getBuyOrderCount(StockInterface $stock): int
    {
        return $this->getOrderBookForStock($stock)->getStatistics()->getTotalBuyOrders();
    }

    /**
     * @param StockInterface $stock
     * @return int
     */
    public function getSellOrderCount(StockInterface $stock): int
    {
        return $this->getOrderBookForStock($stock)->getStatistics()->getTotalSellOrders();
    }

    /**
     * @param StockInterface $stock
     * @return float
     */
    public function getAvgBuyPrice(StockInterface $stock): float
    {
        return $this->getOrderBookForStock($stock)->getStatistics()->getAvgBuyPrice();
    }

    /**
     * @param StockInterface $stock
     * @return float
     */
    public function getAvgSellPrice(StockInterface $stock): float
    {
        return $this->getOrderBookForStock($stock)->getStatistics()->getAvgSellPrice();
    }

    /**
     * Represent order statistics as array for all stock this broker manages
     * @return array
     */
    public function toArray(): array
    {
        $output = [];
        foreach ($this->orderBooks as $stock => $orderBook) {
            $statistics = $orderBook->getStatistics();
            $output[$stock] = [
                'avg_buy_price' => $statistics->getAvgBuyPrice(),
                'avg_sell_price' => $statistics->getAvgSellPrice(),
                'sell_orders' => $statistics->getTotalSellOrders(),
                'buy_orders' => $statistics->getTotalBuyOrders(),
                'orders' => $orderBook->count()
            ];
        }
        return $output;
    }

    /**
     * Get orderbook, or create a new one
     * @param StockInterface $stock
     * @return OrderBook
     */
    protected function getOrderBookForStock(StockInterface $stock): OrderBook
    {
        if (!isset($this->orderBooks[$stock->getName()])) {
            $this->orderBooks[$stock->getName()] = new OrderBook();
        }
        return $this->orderBooks[$stock->getName()];
    }


}