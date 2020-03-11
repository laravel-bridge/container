<?php

namespace Tests\Unit\Pimple;

use Illuminate\Container\Container as LaravelContainer;
use LaravelBridge\Container\Pimple\ContainerWrapper;
use PHPUnit\Framework\TestCase;

class ContainerWrapperTest extends TestCase
{
    /**
     * @test
     */
    public function shouldRegisterOnLaravelContainerUsingContainerWrapper(): void
    {
        $actual = new LaravelContainer();
        $actual->instance('foo', 'foo');

        $target = new ContainerWrapper($actual);
        $target->setContainer($actual);

        $target['bar'] = function ($c) {
            return 'bar' . $c->get('foo');
        };

        $this->assertSame('barfoo', $actual->make('bar'));
        $this->assertSame('barfoo', $target->get('bar'));
    }
}
