<?php

declare(strict_types=1);

namespace LaravelBridge\Container\Pimple;

use LaravelBridge\Container\Traits\ContainerAwareTrait;
use Pimple\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class ServiceProviderBridge
{
    use ContainerAwareTrait;

    /**
     * @param ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function register(ServiceProviderInterface $provider): ServiceProviderBridge
    {
        $wrapper = new ContainerWrapper();
        $wrapper->setContainer($this->container);

        $provider->register($wrapper);

        return $this;
    }
}
