<?php

declare(strict_types=1);

namespace LaravelBridge\Container\Pimple;

use LaravelBridge\Container\Traits\PsrContainerAwareTrait;
use Pimple\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class ServiceProviderBridge
{
    use PsrContainerAwareTrait;

    /**
     * @var ContainerWrapper
     */
    private $wrapper;

    /**
     * @param ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->container = $container;

        $this->wrapper = new ContainerWrapper($this->container);
    }

    public function register(ServiceProviderInterface $provider): ServiceProviderBridge
    {
        $provider->register($this->wrapper);

        return $this;
    }
}
