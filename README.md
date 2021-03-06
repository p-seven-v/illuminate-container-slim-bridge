# Illuminate container integration with Slim

[![Packagist Version](https://img.shields.io/packagist/v/p7v/illuminate-container-slim-bridge)](https://packagist.org/packages/p7v/illuminate-container-slim-bridge)

This package configures Slim to work with the [Illuminate container](https://laravel.com/docs/container). By default, container supports autowiring.

## Install

```
composer require p7v/illuminate-container-slim-bridge
```

## Minimal setup

Instead of using the official `Slim\Factory\AppFactory`, use `Bridge` class to create your application:

```php
<?php
require 'vendor/autoload.php';

$app = \P7v\IlluminateContainerSlim\Bridge::create();
```

## Setup with preconfigured container

If you need to configure the container beforehand, pass your configured container to the method:

```php
<?php
require 'vendor/autoload.php';

$container = new \Illuminate\Container\Container();

/** Configure your container */

$app = \P7v\IlluminateContainerSlim\Bridge::create($container);
```

## Configure container using service providers

You can use service providers for container configuration. Your service provider has to extend `P7v\IlluminateContainerSlim\ServiceProvider`. Then provide list of names of your service providers to `usingProviders` method in Bridge.

```php
class AppServiceProvider extends \P7v\IlluminateContainerSlim\ServiceProvider
{
    public function register(): void
    {
        $this->bind('key', function () {
            return new stdClass();
        });
        
        $this->singleton(RepositoryInterface::class, Repository::class);
    }
}
```

```php
<?php
require 'vendor/autoload.php';

$providers = [
    AppServiceProvider::class,
];

$app = \P7v\IlluminateContainerSlim\Bridge::usingProviders($providers);
```
