<?php

declare(strict_types=1);

namespace LaravelBridge\Container\Pimple;

use ArrayAccess;
use DI\Container as PHPDIContainer;
use LaravelBridge\Container\NotFoundException;
use LaravelBridge\Container\Traits\ContainerWrapperTrait;
use Pimple\Container as PimpleContainer;
use Psr\Container\ContainerInterface;

class ContainerWrapper extends PimpleContainer
{
    use ContainerWrapperTrait;

    /**
     * @param ContainerInterface $container
     * @param array $values
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
    public function offsetSet($id, $value)
    {
        if ($this->container instanceof ArrayAccess) {
            $this->container->offsetSet($id, $value);
            return;
        }

        if ($this->container instanceof PHPDIContainer) {
            $this->container->set($id, $value);
            return;
        }

        $this->throwException();
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
     * @return bool
     */
    public function offsetExists($id)
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
    public function offsetUnset($id)
    {
        if ($this->container instanceof ArrayAccess) {
            $this->container->offsetUnset($id);
            return;
        }

        $this->throwException();
    }

    private function throwException()
    {
        $class = get_class($this->container);

        throw new NotFoundException("Cannot access {$class} via ContainerWrapper");
    }
}
