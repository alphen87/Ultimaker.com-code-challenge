<?php

namespace Ultimaker\Challenge\Domain;

interface OrderInterface
{
    const TYPE_BUY = 'buy';
    const TYPE_SELL = 'sell';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @return int
     */
    public function getQuantity(): int;
}