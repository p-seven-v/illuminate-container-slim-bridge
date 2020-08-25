# Illuminate container integration with Slim

[![Packagist Version](https://img.shields.io/packagist/v/p7v/illuminate-container-slim-bridge)](https://packagist.org/packages/p7v/illuminate-container-slim-bridge)

This package configures Slim to work with the [Illuminate container](https://laravel.com/docs/container).

## Setup

```
composer require p7v/illuminate-container-slim-bridge
```

Instead of using the official `Slim\Factory\AppFactory`, use `Bridge` class to create your application:

```php
<?php
require 'vendor/autoload.php';

$app = \P7v\IlluminateContainerSlim\Bridge::create();
```

If you need to configure the container beforehand, pass your configured container to the method:

```php
<?php
require 'vendor/autoload.php';

$container = new \Illuminate\Container\Container();

/** Configure your container */

$app = \P7v\IlluminateContainerSlim\Bridge::create($container);
```
