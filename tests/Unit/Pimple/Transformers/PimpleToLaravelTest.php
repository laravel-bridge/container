<?php

namespace Tests\Unit\Pimple;

use LaravelBridge\Container\Pimple\Transformers\PimpleToLaravel;
use PHPUnit\Framework\TestCase;
use Pimple\Container;

class PimpleToLaravelTest extends TestCase
{
    /**
     * @test
     */
    public function shouldRegisterOnLaravelContainerUsingContainerWrapper(): void
    {
        $pimple = new Container();
        $pimple['foo'] = 'foo';
        $pimple['bar'] = function (Container $app) {
            return 'bar' . $app['foo'];
        };

        $actual = (new PimpleToLaravel($pimple))->transform();

        $this->assertSame('foo', $actual->make('foo'));
        $this->assertSame('barfoo', $actual->make('bar'));
    }
}
