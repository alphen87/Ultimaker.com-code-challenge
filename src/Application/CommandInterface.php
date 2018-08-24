<?php

namespace Ultimaker\Challenge\Application;

interface CommandInterface
{
    public function execute(): void;
}