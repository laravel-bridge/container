# Container Bridge

[![Build Status](https://travis-ci.com/laravel-bridge/support.svg?branch=master)](https://travis-ci.com/laravel-bridge/container)
[![codecov](https://codecov.io/gh/laravel-bridge/support/branch/master/graph/badge.svg)](https://codecov.io/gh/laravel-bridge/container)
[![Latest Stable Version](https://poser.pugx.org/MilesChou/parkdown/v/stable)](https://packagist.org/packages/laravel-bridge/container)
[![Total Downloads](https://poser.pugx.org/MilesChou/parkdown/d/total.svg)](https://packagist.org/packages/laravel-bridge/container)
[![License](https://poser.pugx.org/MilesChou/parkdown/license)](https://packagist.org/packages/laravel-bridge/container)

The PSR-11 container bridges.

## Pimple bridge to others

Build the wrapper.

```php
// Laravel Container
$actualContainer = new \Illuminate\Container\Container();
$actualContainer->instance('foo', 'foo');

$wrapper = new \LaravelBridge\Container\Pimple\ContainerWrapper();
$wrapper->setContainer($actualContainer);

// Use like the Pimple Container, but it will register on Laravel Container
$wrapper['bar'] = function($c) {
    return 'bar' . $c->get('foo');
};

$wrapper->get('bar'); // 'barfoo'
$actualContainer->make('bar'); // 'barfoo'
```

Use ServiceProvider bridge

```php
// Laravel Container
$actualContainer = new \Illuminate\Container\Container();

$bridge = new \LaravelBridge\Container\Pimple\ServiceProviderBridge($actualContainer);

$bridge->register(new YourPimpleServiceProvider());
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
