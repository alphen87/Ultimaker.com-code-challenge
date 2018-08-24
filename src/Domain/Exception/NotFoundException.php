<?php

namespace Ultimaker\Challenge\Domain\Exception;

class NotFoundException extends \Exception
{
    const MESSAGE = 'Cannot find "%s" with id "%s"';

    /**
     * NotFoundException constructor.
     * @param string $entity
     * @param string $id
     */
    public function __construct(string $entity, string $id)
    {
        $message = sprintf(self::MESSAGE, $entity, $id);
        return parent::__construct($message);
    }
}