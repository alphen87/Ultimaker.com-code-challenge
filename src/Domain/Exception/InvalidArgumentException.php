<?php

namespace Ultimaker\Challenge\Domain\Exception;

class InvalidArgumentException extends \Exception
{
    const MESSAGE = 'Invalid argument "%s"';

    /**
     * InvalidArgumentException constructor.
     * @param string $argument
     */
    public function __construct(string $argument)
    {
        $message = sprintf(self::MESSAGE, $argument);
        return parent::__construct($message);
    }
}