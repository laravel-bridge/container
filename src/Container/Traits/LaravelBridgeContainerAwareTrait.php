<?php

declare(strict_types=1);

namespace LaravelBridge\Container\Traits;

use LaravelBridge\Scratch\Application;

trait LaravelBridgeContainerAwareTrait
{
    /**
     * @var Application
     */
    protected $container;

    /**
     * @return Application
     */
    public function getContainer(): Application
    {
        return $this->container;
    }

    /**
     * @param Application $container
     * @return static
     */
    public function setContainer(Application $container)
    {
        $this->container = $container;

        return $this;
    }
}
