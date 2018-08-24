<?php

namespace UltimakerTest\Challenge\Infrastructure\Container;

use PHPUnit\Framework\TestCase;
use Ultimaker\Challenge\Infrastructure\Container\Container;
use Ultimaker\Challenge\Infrastructure\Container\InvalidArgumentException;
use Ultimaker\Challenge\Infrastructure\Container\NotFoundException;
use UltimakerTest\Challenge\Infrastructure\Container\Mock\SimpleMockObject;
use UltimakerTest\Challenge\Infrastructure\Container\Mock\SimpleMockObjectFactory;
use UltimakerTest\Challenge\Infrastructure\Container\Mock\SimpleMockObjectParent;
use UltimakerTest\Challenge\Infrastructure\Container\Mock\SimpleMockObjectParentFactory;

class ContainerTest extends TestCase
{
    public function testContainerSetSimple()
    {
        $container = new Container();
        $container->set(SimpleMockObject::class, SimpleMockObjectFactory::class);

        $this->assertTrue($container->has(SimpleMockObject::class));
        $this->assertInstanceOf(SimpleMockObject::class, $container->get(SimpleMockObject::class));
    }

    public function testContainerSetWithRecursion()
    {
        $container = new Container();
        $container->set(SimpleMockObjectParent::class, SimpleMockObjectParentFactory::class);
        $container->set(SimpleMockObject::class, SimpleMockObjectFactory::class);

        $this->assertTrue($container->has(SimpleMockObject::class));
        $this->assertTrue($container->has(SimpleMockObjectParent::class));

        /** @var SimpleMockObjectParent $instance */
        $instance = $container->get(SimpleMockObjectParent::class);

        $this->assertInstanceOf(SimpleMockObjectParent::class, $instance);
        $this->assertInstanceOf(SimpleMockObject::class, $instance->getChild());
    }

    public function testContainerSetShouldOverwrite()
    {
        $container = new Container();
        //required to be in the container to construct a parent mock
        $container->set(SimpleMockObject::class, SimpleMockObjectFactory::class);
        $container->set('test', SimpleMockObjectParentFactory::class);

        $instance = $container->get('test');
        $this->assertInstanceOf(SimpleMockObjectParent::class, $instance);

        // overwrite the test entry with another definition
        $container->set('test', SimpleMockObjectFactory::class);

        $instance = $container->get('test');
        $this->assertInstanceOf(SimpleMockObject::class, $instance);
    }

    public function testContainerGetShouldReturnFromCache()
    {
        $container = new Container();
        $container->set(SimpleMockObject::class, SimpleMockObjectFactory::class);

        $instance1 = $container->get(SimpleMockObject::class);
        $instance2 = $container->get(SimpleMockObject::class);

        $this->assertInstanceOf(SimpleMockObject::class, $instance1);
        $this->assertInstanceOf(SimpleMockObject::class, $instance2);
        $this->assertSame($instance1, $instance2);
    }

    public function testContainerSetWithInvalidFactoryShouldThrowException()
    {
        $container = new Container();

        $this->expectException(InvalidArgumentException::class);
        $container->set(SimpleMockObject::class, 'invalid');

        $this->assertFalse($container->has(SimpleMockObject::class));
    }

    public function testContainerShouldThrowExceptionWhenNotFound()
    {
        $container = new Container();

        $this->expectException(NotFoundException::class);
        $container->get(SimpleMockObject::class);
    }
}