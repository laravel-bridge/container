<?php

namespace Tests\Unit\Pimple\Fixture;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class TestServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['bar'] = function (ContainerInterface $c) {
            return 'bar' . $c->get('foo');
        };
    }
}
