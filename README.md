# Zend Expressive Sentry ErrorHandler

[![Latest Stable Version](https://poser.pugx.org/geo6/zend-expressive-sentry/v/stable)](https://packagist.org/packages/geo6/zend-expressive-sentry)
[![Total Downloads](https://poser.pugx.org/geo6/zend-expressive-sentry/downloads)](https://packagist.org/packages/geo6/zend-expressive-sentry)
[![Monthly Downloads](https://poser.pugx.org/geo6/zend-expressive-sentry/d/monthly.png)](https://packagist.org/packages/geo6/zend-expressive-sentry)
[![Software License](https://img.shields.io/badge/license-GPL--3.0-brightgreen.svg)](LICENSE)

This library enables Zend Expressive to send errors and exceptions to [Sentry.io](https://sentry.io/).

## Install

```
composer require geo6/zend-expressive-sentry
```

## Configuration

Create a `sentry.global.php` file in your `config` directory with your correct DSN (and options, if necessary):

```php
<?php

declare(strict_types=1);

return [
    'sentry' => [
        'dsn' => 'https://xxxxx@sentry.io/12345',
    ],
];
```

## Usage

To enable it, you just have to add `Geo6\Expressive\Sentry\ConfigProvider::class` to your main configuration (usually `config/config.php`):

```diff
...

$aggregator = new ConfigAggregator([
+     Geo6\Expressive\Sentry\ConfigProvider::class,
...
], $cacheConfig['config_cache_path']);

...
```

The Sentry ErrorHandler will be active only in "production mode" (when `$config['debug]` is `false`).  
To switch to "production mode", you can use `composer run development-disable`.

---

This library was inspired by [`stickeeuk/zend-expressive-sentry`](https://github.com/stickeeuk/zend-expressive-sentry).  
The main difference is that this library uses the last version of the [PHP SDK](https://docs.sentry.io/clients/php/).