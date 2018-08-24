<?php

namespace Ultimaker\Challenge\Domain;


class OrderBook implements OrderBookInterface
{
    /**
     * @var OrderInterface[]
     */
    protected $orders = [];

    /**
     * @param OrderInterface $order
     */
    public function add(OrderInterface $order): void
    {
        $this->orders[] = $order;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->orders);
    }

    /**
     * @return OrderBookStatisticsInterface
     */
    public function getStatistics(): OrderBookStatisticsInterface
    {
        $totalBuyOrders = 0;
        $totalSellOrders = 0;

        $sellOrderPrices = [];
        $buyOrderPrices = [];

        foreach ($this->orders as $order) {
            switch ($order->getType()) {
                case OrderInterface::TYPE_BUY:
                    $totalBuyOrders++;
                    $buyOrderPrices = array_merge($buyOrderPrices, $this->extractPrices($order));
                    break;

                case OrderInterface::TYPE_SELL:
                    $totalSellOrders++;
                    $sellOrderPrices = array_merge($sellOrderPrices, $this->extractPrices($order));
                    break;
            }
        }

        $avgBuyPrice = $this->calculateAvg($buyOrderPrices);
        $avgSellPrice = $this->calculateAvg($sellOrderPrices);

        return new OrderBookStatistics($totalBuyOrders, $totalSellOrders, $avgBuyPrice, $avgSellPrice);
    }

    /**
     * Get an array with
     * @param OrderInterface $order
     * @return array
     */
    private function extractPrices(OrderInterface $order): array
    {
        return array_fill(1, $order->getQuantity(), $order->getPrice());
    }

    /**
     * Calculate the average of an array of floats
     * @param array<float> $floats
     * @return float
     */
    private function calculateAvg(array $floats): float
    {
        //avoid division by zero
        if (count($floats) == 0) {
            return 0;
        } else {
            return round(array_sum($floats) / count($floats), 2);
        }
    }

}