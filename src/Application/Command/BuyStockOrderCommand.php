<?php

namespace Ultimaker\Challenge\Application\Command;

class BuyStockOrderCommand extends AbstractStockOrderCommand
{
    public function execute(): void
    {
        $this->broker->buy($this->stock, $this->price, $this->quantity);
    }
}