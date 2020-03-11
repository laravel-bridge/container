<?php

declare(strict_types=1);

namespace LaravelBridge\Container\Pimple\Transformers;

use Illuminate\Container\Container;
use Illuminate\Container\Container as LaravelContainer;
use LaravelBridge\Container\Contracts\TransformToLaravel;
use Pimple\Container as PimpleContainer;

class PimpleToLaravel implements TransformToLaravel
{
    /**
     * @var LaravelContainer
     */
    private $laravel;

    /**
     * @var PimpleContainer
     */
    private $pimple;

    public function __construct(PimpleContainer $pimple, LaravelContainer $laravel = null)
    {
        $this->pimple = $pimple;
        $this->laravel = $laravel ?: new Container();
    }

    public function transform(): LaravelContainer
    {
        $this->laravel->singleton(PimpleContainer::class, function () {
            return $this->pimple;
        });

        $keys = $this->pimple->keys();

        foreach ($keys as $registeredKey) {
            $this->laravel->singleton($registeredKey, function (Container $app) use ($registeredKey) {
                /** @var PimpleContainer $pimple */
                $pimple = $app->make(PimpleContainer::class);

                return $pimple[$registeredKey];
            });
        }

        return $this->laravel;
    }
}
