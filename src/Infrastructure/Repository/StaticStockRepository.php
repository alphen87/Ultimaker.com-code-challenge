<?php

namespace Ultimaker\Challenge\Infrastructure\Repository;

use Ultimaker\Challenge\Domain\Exception\NotFoundException;
use Ultimaker\Challenge\Domain\Stock;
use Ultimaker\Challenge\Domain\StockInterface;
use Ultimaker\Challenge\Domain\StockRepositoryInterface;

class StaticStockRepository implements StockRepositoryInterface
{
    /**
     * Static list of stock symbols
     * @var array
     */
    private $list = [
        'BABA',
        'AAPL',
        'MSFT',
        'QCOM',
        'ATVI',
        'TSLA',
        'NVDA'
    ];

    /**
     * @param string $name
     * @return Stock
     * @throws NotFoundException
     */
    public function getByName(string $name): StockInterface
    {
        if (in_array($name, $this->list)) {
            return new Stock($name);
        } else {
            throw new NotFoundException('stock', $name);
        }
    }

}