<?php 

return [

    /*
    |--------------------------------------------------------------------------
    | Environment Specific Packages Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file is used to define any package requirements that 
    | are loaded over some specific environment like you might have some 
    | development packages installed that you do not wish to load over 
    | production and/or staging.
    |
    | Usage:
    | You can define any requirement in any environment. So to define a provider
    | for the local environment, you just need to add it like this:
    |
    | 'providers' => [
    |     'local'  => [
    |         Provider\Package\SomeServiceProvider::class,
    |     ],
    | ],
    |
    | In case you need to load this provider in multiple environments like
    | local, testing and development, you can do so like this:
    | 
    | 'providers' => [
    |     'local,testing,development'  => [
    |         Provider\Package\SomeServiceProvider::class,
    |     ],
    | ],
    | 
    | You can also do any kind of combinations in configuration like this:
    |
    | 'providers' => [
    |     'local,testing,development'  => [
    |         Provider\Package\SomeServiceProvider::class,
    |     ],
    |     'development'  => [
    |         Provider\Package\OtherServiceProvider::class,
    |     ],
    |     'staging,production'  => [
    |         Provider\Package\AnotherServiceProvider::class,
    |     ],
    | ],
    | 
    */


    /*
    |--------------------------------------------------------------------------
    | Environment specific ServiceProviders list
    |--------------------------------------------------------------------------
    */
    'providers' => [
        'local'               => [
            // e.g. Provider\Package\SomeServiceProvider::class,
        ],
        'development'         => [],
        'production'          => [],
    ],


    /*
    |--------------------------------------------------------------------------
    | Environment specific Alias list
    |--------------------------------------------------------------------------
    */
    'aliases' => [
        'local'               => [
            // e.g. 'Alias' => Provider\Package\Facades\AliasClass::class,
        ],
        'development'         => [],
        'staging,production'  => []
    ],


    /*
    |--------------------------------------------------------------------------
    | Environment specific Middlewares list
    |--------------------------------------------------------------------------
    */
    'middlewares' => [
        'local,dev,testing'   => [
            // e.g. Provider\Package\Middleware\SomeMiddleware::class,
        ],
        'development'         => [],
        'production'          => []
    ],


    /*
    |--------------------------------------------------------------------------
    | Environment specific Router Middlewares list
    |--------------------------------------------------------------------------
    */
    'routerMiddlewares' => [
        'local,dev,testing'   => [
            // e.g. 'example' => Provider\Package\Middleware\SomeAliasedMiddleware::class,
        ],
        'development'         => [],
        'production'          => []
    ],
];
