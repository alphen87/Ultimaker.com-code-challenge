<?php

namespace Ultimaker\Challenge\Infrastructure\Container;

use Psr\Container\ContainerExceptionInterface;

class InvalidArgumentException extends \Exception implements ContainerExceptionInterface
{
    const MESSAGE = 'Invalid entry: "%s", please make use of '.FactoryInterface::class . ' and make sure the class can be auto loaded.';

    /**
     * NotFoundException constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $message = sprintf(self::MESSAGE, $id);
        return parent::__construct($message);
    }
}