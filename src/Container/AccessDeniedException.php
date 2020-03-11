<?php

declare(strict_types=1);

namespace LaravelBridge\Container;

use Psr\Container\ContainerExceptionInterface;

class AccessDeniedException extends \LogicException implements ContainerExceptionInterface
{
}
