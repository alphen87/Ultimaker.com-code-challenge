<?php

namespace UltimakerTest\Challenge\Domain;

use PHPUnit\Framework\TestCase;
use Ultimaker\Challenge\Domain\Broker;
use Ultimaker\Challenge\Domain\StockInterface;

class BrokerTest extends TestCase
{

    public function testAddBuyOrder()
    {
        $stock = $this->createStockMock('test');

        $broker = new Broker();
        $broker->buy($stock, 10, 5);

        $this->assertEquals(1, $broker->getBuyOrderCount($stock));
        $this->assertEquals(1, $broker->getTotalOrderCount($stock));
    }

    public function testAddSellOrder()
    {
        $stock = $this->createStockMock('test');

        $broker = new Broker();
        $broker->sell($stock, 15, 2);

        $this->assertEquals(1, $broker->getSellOrderCount($stock));
        $this->assertEquals(1, $broker->getTotalOrderCount($stock));
    }

    public function testAddMultipleStock()
    {
        $stock1 = $this->createStockMock('test1');
        $stock2 = $this->createStockMock('test2');

        $broker = new Broker();
        $broker->sell($stock1, 15, 2);
        $broker->buy($stock2, 15, 4);

        $this->assertEquals(1, $broker->getTotalOrderCount($stock1));
        $this->assertEquals(1, $broker->getTotalOrderCount($stock2));

    }

    public function testPriceAverages()
    {
        $stock = $this->createStockMock('test');

        $broker = new Broker();
        $broker->buy($stock, 1.51, 1);
        $broker->buy($stock, 2.53, 3);
        $broker->buy($stock, 1.65, 2);

        $broker->sell($stock, 10, 1);
        $broker->sell($stock, 5, 1);

        $this->assertEquals(5, $broker->getTotalOrderCount($stock));
        $this->assertEquals(3, $broker->getBuyOrderCount($stock));
        $this->assertEquals(2, $broker->getSellOrderCount($stock));

        // (1.51 + 2.53 + 2.53 + 2.53 + 1.65 + 1.65) / 6 = 2.07
        $this->assertEquals(2.07, $broker->getAvgBuyPrice($stock));
        // (10 + 5) / 2 = 7.50
        $this->assertEquals(7.50, $broker->getAvgSellPrice($stock));
    }

    /**
     * @param string $name
     * @return StockInterface
     */
    protected function createStockMock(string $name): StockInterface
    {
        $mock = $this->createMock(StockInterface::class);
        $mock->method('getName')
            ->willReturn($name);

        return $mock;
    }
}