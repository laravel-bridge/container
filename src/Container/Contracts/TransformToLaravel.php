<?php

namespace LaravelBridge\Container\Contracts;

use Illuminate\Container\Container;

interface TransformToLaravel
{
    /**
     * @return Container
     */
    public function transform(): Container;
}
