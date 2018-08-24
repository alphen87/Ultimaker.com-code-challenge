<?php

namespace Ultimaker\Challenge\Domain;

interface OrderBookInterface extends \Countable
{
    /**
     * @param OrderInterface $order
     */
    public function add(OrderInterface $order): void;

    /**
     * @return OrderBookStatisticsInterface
     */
    public function getStatistics(): OrderBookStatisticsInterface;
}