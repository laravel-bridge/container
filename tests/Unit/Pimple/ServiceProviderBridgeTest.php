<?php

namespace Tests\Unit\Pimple;

use DI\Container as PHPDIContainer;
use Illuminate\Container\Container as LaravelContainer;
use LaravelBridge\Container\Pimple\ServiceProviderBridge;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Pimple\Fixture\TestServiceProvider;

class ServiceProviderBridgeTest extends TestCase
{
    /**
     * @test
     */
    public function shouldRegisterOnLaravelContainerUsingPimpleServiceProvider(): void
    {
        $actual = new LaravelContainer();
        $actual->instance('foo', 'baz');

        $target = new ServiceProviderBridge($actual);
        $target->register(new TestServiceProvider());

        $this->assertSame('baz', $actual->make('foo'));
        $this->assertSame('barbaz', $actual->make('bar'));
    }

    /**
     * @test
     */
    public function shouldRegisterOnPHPDIContainerUsingPimpleServiceProvider(): void
    {
        $actual = new PHPDIContainer();
        $actual->set('foo', 'baz');

        $target = new ServiceProviderBridge($actual);
        $target->register(new TestServiceProvider());

        $this->assertSame('baz', $actual->make('foo'));
        $this->assertSame('barbaz', $actual->make('bar'));
    }
}
