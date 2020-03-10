<?php

declare(strict_types=1);

namespace LaravelBridge\Container\Pimple;

use ArrayAccess;
use DI\Container as PHPDIContainer;
use LaravelBridge\Container\AccessDeniedException;
use LaravelBridge\Container\Traits\ContainerWrapperTrait;
use Pimple\Container as PimpleContainer;
use Psr\Container\ContainerInterface;

class ContainerWrapper extends PimpleContainer implements ContainerInterface
{
    use ContainerWrapperTrait;

    /**
     * @param ContainerInterface $container
     * @param array<mixed> $values
     */
    public function __construct(ContainerInterface $container, array $values = [])
    {
        $this->setContainer($container);

        parent::__construct($values);
    }

    /**
     * @param string $id
     * @param mixed $value
     */
    public function offsetSet($id, $value): void
    {
        if ($this->container instanceof ArrayAccess) {
            $this->container->offsetSet($id, $value);
            return;
        }

        if ($this->container instanceof PHPDIContainer) {
            $this->container->set($id, $value);
            return;
        }

        $this->throwException(__METHOD__);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function offsetGet($id)
    {
        if ($this->container instanceof ArrayAccess) {
            return $this->container->offsetGet($id);
        }

        // Include PHPDIContainer
        return $this->container->get($id);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function offsetExists($id): bool
    {
        if ($this->container instanceof ArrayAccess) {
            return $this->container->offsetExists($id);
        }

        // Include PHPDIContainer
        return $this->container->has($id);
    }

    /**
     * @param string $id
     */
    public function offsetUnset($id): void
    {
        if ($this->container instanceof ArrayAccess) {
            $this->container->offsetUnset($id);
            return;
        }

        $this->throwException(__METHOD__);
    }

    /**
     * @param string $method
     */
    private function throwException(string $method): void
    {
        $class = get_class($this->container);

        throw new AccessDeniedException("Cannot access {$class} via ContainerWrapper::{$method}");
    }
}
