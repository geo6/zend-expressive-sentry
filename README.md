# Zend Expressive Sentry ErrorHandler

[![Latest Stable Version](https://poser.pugx.org/geo6/zend-expressive-sentry/v/stable)](https://packagist.org/packages/geo6/zend-expressive-sentry)
[![Total Downloads](https://poser.pugx.org/geo6/zend-expressive-sentry/downloads)](https://packagist.org/packages/geo6/zend-expressive-sentry)
[![Monthly Downloads](https://poser.pugx.org/geo6/zend-expressive-sentry/d/monthly.png)](https://packagist.org/packages/geo6/zend-expressive-sentry)
[![Software License](https://img.shields.io/badge/license-GPL--3.0-brightgreen.svg)](LICENSE)

This library enables Zend Expressive to send errors and exceptions to [Sentry.io](https://sentry.io/).

## Configuration

Create a `sentry.global.php` file in your `config` directory:

```php
<?php

declare(strict_types=1);

return [
    'sentry' => [
        'dsn' => 'https://0fd462c09bcb47449b4f47e01440a9d5@sentry.io/1532400',
    ],
];
```

## Usage

To enable it, you just have to add `Geo6\Sentry\ConfigProvider::class` to your main configuration (usually `config/config.php`):

```diff
<?php

declare(strict_types=1);

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

// To enable or disable caching, set the `ConfigAggregator::ENABLE_CACHE` boolean in
// `config/autoload/local.php`.
$cacheConfig = [
    'config_cache_path' => 'data/cache/config-cache.php',
];

$aggregator = new ConfigAggregator([
+     Geo6\Sentry\ConfigProvider::class,

    // Include cache configuration
    new ArrayProvider($cacheConfig),

    // Default App module config
    App\ConfigProvider::class,

    // Load application config in a pre-defined order in such a way that local settings
    // overwrite global settings. (Loaded as first to last):
    //   - `global.php`
    //   - `*.global.php`
    //   - `local.php`
    //   - `*.local.php`
    new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),

    // Load development config if it exists
    new PhpFileProvider(realpath(__DIR__) . '/development.config.php'),
], $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
```



---

This library was inspired by [`stickeeuk/zend-expressive-sentry`](https://github.com/stickeeuk/zend-expressive-sentry).  
The main difference is that this library uses the last version of the [PHP SDK](https://docs.sentry.io/clients/php/).