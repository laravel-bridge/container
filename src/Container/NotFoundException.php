<?php

namespace LaravelBridge\Container;

use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends \LogicException implements NotFoundExceptionInterface
{
}
