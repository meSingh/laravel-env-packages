# Laravel Environment Specific Packages

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)

This package lets you define various package requirements according to the environment.

## Install

Via Composer

``` bash
$ composer require meSingh/laravel-env-packages
```

Then add the service provider in `config/app.php`:

``` php
meSingh\EnvPackages\EnvPackagesServiceProvider::class,
```

Then publish vendor files for access the configuration file:

``` bash
$ php artisan vendor:publish --provider="meSingh\EnvPackages\EnvPackagesServiceProvider"
```

## Usage

You need to run ```envpackages:generate``` command after each configuration update.

``` bash
$ php artisan envpackages:generate
```

## Configuration

```envpackages.php``` file is used to define any package requirements that are loaded over some specific environment like you might have some 
development packages installed that you do not wish to load over production and/or staging.

You can define any requirement in any environment. So to define a provider for the local environment, you just need to add it like this:

``` php
'providers' => [
    'local'  => [
        Provider\Package\SomeServiceProvider::class,
    ],
],
```

In case you need to load this provider in multiple environments like local, testing and development, you can do so like this:

``` php
'providers' => [
    'local,testing,development'  => [
        Provider\Package\SomeServiceProvider::class,
    ],
],
```

You can also do any kind of combinations in configuration like this:

``` php
'providers' => [
    'local,testing,development'  => [
        Provider\Package\SomeServiceProvider::class,
    ],
    'development'  => [
        Provider\Package\OtherServiceProvider::class,
    ],
    'staging,production'  => [
        Provider\Package\AnotherServiceProvider::class,
    ],
],
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/meSingh/laravel-env-packages.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/meSingh/laravel-env-packages

