<?php

namespace Ultimaker\Challenge\Application\Command;

use Ultimaker\Challenge\Application\CommandInterface;
use Ultimaker\Challenge\Domain\BrokerInterface;
use Ultimaker\Challenge\Domain\StockInterface;

abstract class AbstractStockOrderCommand implements CommandInterface
{
    /**
     * @var BrokerInterface
     */
    protected $broker;

    /**
     * @var StockInterface
     */
    protected $stock;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var float
     */
    protected $price;

    /**
     * AbstractStockCommand constructor.
     * @param BrokerInterface $broker
     * @param StockInterface $stock
     * @param int $quantity
     * @param float $price
     */
    public function __construct(
        BrokerInterface $broker,
        StockInterface $stock,
        int $quantity,
        float $price
    )
    {
        $this->broker = $broker;
        $this->stock = $stock;
        $this->quantity = $quantity;
        $this->price = $price;
    }


}