<?php

namespace Ultimaker\Challenge\Domain;

class Stock implements StockInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Stock constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}