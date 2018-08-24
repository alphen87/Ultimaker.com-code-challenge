<?php

namespace Ultimaker\Challenge\Application\Command;

class SellStockOrderCommand extends AbstractStockOrderCommand
{
    public function execute(): void
    {
        $this->broker->sell($this->stock, $this->price, $this->quantity);
    }
}