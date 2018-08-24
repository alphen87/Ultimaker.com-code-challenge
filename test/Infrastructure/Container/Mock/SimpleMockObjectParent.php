<?php

namespace UltimakerTest\Challenge\Infrastructure\Container\Mock;

class SimpleMockObjectParent
{
    /**
     * @var SimpleMockObject
     */
    protected $child;

    /**
     * SimpleMockObjectParent constructor.
     * @param SimpleMockObject $child
     */
    public function __construct(SimpleMockObject $child)
    {
        $this->child = $child;
    }

    /**
     * @return SimpleMockObject
     */
    public function getChild(): SimpleMockObject
    {
        return $this->child;
    }
}