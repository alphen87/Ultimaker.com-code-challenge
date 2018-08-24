<?php

namespace Ultimaker\Challenge\Application\Service;

use Ultimaker\Challenge\Application\Command\BuyStockOrderCommand;
use Ultimaker\Challenge\Application\Command\SellStockOrderCommand;
use Ultimaker\Challenge\Application\Dto\BrokerStatisticsDto;
use Ultimaker\Challenge\Application\Dto\StockStatisticsDto;
use Ultimaker\Challenge\Application\Service\Exception\InvalidArgumentException;
use Ultimaker\Challenge\Domain\BrokerInterface;
use Ultimaker\Challenge\Domain\Exception\NotFoundException;
use Ultimaker\Challenge\Domain\StockInterface;
use Ultimaker\Challenge\Domain\StockRepositoryInterface;

class BrokerService implements BrokerServiceInterface
{
    /**
     * @var BrokerInterface
     */
    protected $broker;

    /**
     * @var StockRepositoryInterface
     */
    protected $stockRepository;

    /**
     * BrokerService constructor.
     * @param BrokerInterface $broker
     * @param StockRepositoryInterface $stockRepository
     */
    public function __construct(BrokerInterface $broker, StockRepositoryInterface $stockRepository)
    {
        $this->broker = $broker;
        $this->stockRepository = $stockRepository;
    }

    /**
     * @param string $stock
     * @param float $price
     * @param int $quantity
     * @throws InvalidArgumentException
     */
    public function placeBuyOrder(string $stock, float $price, int $quantity): void
    {
        $stock = $this->getStock($stock);
        $command = new BuyStockOrderCommand($this->broker, $stock, $quantity, $price);
        $command->execute();
    }

    /**
     * @param string $stock
     * @param float $price
     * @param int $quantity
     * @throws InvalidArgumentException
     */
    public function placeSellOrder(string $stock, float $price, int $quantity): void
    {
        $stock = $this->getStock($stock);
        $command = new SellStockOrderCommand($this->broker, $stock, $quantity, $price);
        $command->execute();
    }

    /**
     * @return BrokerStatisticsDto
     */
    public function getBrokerStatistics(): BrokerStatisticsDto
    {
        $brokerStatsDto = new BrokerStatisticsDto();
        $statistics = $this->broker->toArray();

        foreach ($statistics as $stock => $stockStatistics)
        {
            $stockStatsDto = new StockStatisticsDto();
            $stockStatsDto->stock = $stock;
            $stockStatsDto->avgBuyPrice = $stockStatistics['avg_buy_price'];
            $stockStatsDto->avgSellPrice = $stockStatistics['avg_sell_price'];
            $stockStatsDto->sellOrdersAmount = $stockStatistics['sell_orders'];
            $stockStatsDto->buyOrdersAmount = $stockStatistics['buy_orders'];
            $stockStatsDto->ordersAmount = $stockStatistics['orders'];
            $brokerStatsDto->stockStatistics[] = $stockStatsDto;
        }

        return $brokerStatsDto;
    }

    /**
     * @param string $stock
     * @return StockInterface
     * @throws InvalidArgumentException
     */
    protected function getStock(string $stock): StockInterface
    {
        try {
            return $this->stockRepository->getByName($stock);
        } catch (NotFoundException $ex) {
            throw new InvalidArgumentException('stock', "cannot find {$stock}");
        }
    }
}