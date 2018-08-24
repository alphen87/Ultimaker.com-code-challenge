<?php

namespace Ultimaker\Challenge\Domain;

use Ultimaker\Challenge\Domain\Exception\NotFoundException;

interface StockRepositoryInterface
{
    /**
     * @param string $name
     * @return Stock
     * @throws NotFoundException
     */
    public function getByName(string $name): StockInterface;
}