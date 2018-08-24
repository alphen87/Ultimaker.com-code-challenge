<?php

namespace Ultimaker\Challenge\Domain;

use Ultimaker\Challenge\Domain\Exception\InvalidArgumentException;

class Order implements OrderInterface
{
    const ALLOWED_TYPES = [
        OrderInterface::TYPE_BUY,
        OrderInterface::TYPE_SELL
    ];

    /**
     * @var string
     */
    protected $type;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * Order constructor.
     * @param string $type
     * @param float $price
     * @param int $quantity
     * @param \DateTime $dateTime
     * @throws InvalidArgumentException
     */
    public function __construct(string $type, float $price, int $quantity, \DateTime $dateTime)
    {
        if (!in_array($type, self::ALLOWED_TYPES)) {
            throw new InvalidArgumentException('type');
        }

        $this->type = $type;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->dateTime = $dateTime;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

}