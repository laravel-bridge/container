<?php

namespace LaravelBridge\Container;

use Psr\Container\ContainerExceptionInterface;

class AccessDeniedException extends \LogicException implements ContainerExceptionInterface
{
}
