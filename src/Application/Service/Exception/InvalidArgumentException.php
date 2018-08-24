<?php

namespace Ultimaker\Challenge\Application\Service\Exception;

class InvalidArgumentException extends \Exception
{
    const MESSAGE = 'Invalid argument "%s": "%s"';

    /**
     * InvalidArgumentException constructor.
     * @param string $argument
     */
    public function __construct(string $argument, string $reason)
    {
        $message = sprintf(self::MESSAGE, $argument, $reason);
        return parent::__construct($message);
    }
}