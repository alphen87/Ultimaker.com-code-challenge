<?php

namespace Ultimaker\Challenge\Infrastructure\Container;

use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends \Exception implements NotFoundExceptionInterface
{
    const MESSAGE = 'Container does not contain a "%s" entry';

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