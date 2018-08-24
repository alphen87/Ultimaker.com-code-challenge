<?php
namespace Ultimaker\Challenge\Domain;

interface StockInterface
{
    /**
     * @return string
     */
    public function getName(): string;
}