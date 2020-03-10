<?php

declare(strict_types=1);

namespace LaravelBridge\Container\Traits;

use Illuminate\Container\Container;

trait LaravelContainerAwareTrait
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @param Container $container
     * @return static
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }
}
