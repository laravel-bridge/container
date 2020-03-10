<?php

declare(strict_types=1);

namespace LaravelBridge\Container\Traits;

trait ContainerWrapperTrait
{
    use PsrContainerAwareTrait;

    /**
     * @param mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->container->get($id);
    }

    /**
     * @param mixed $id
     * @return bool
     */
    public function has($id): bool
    {
        return $this->container->has($id);
    }
}
