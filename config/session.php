<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

use function App\Helpers\env;

return [
    'session' => [
        'default' => env('SESSION_DRIVER'),
        'drivers' => [
            'memcached' => [
                'adapter' => 'Libmemcached',
                'servers' => [
                    [
                        'host' => env('MEMCACHED_HOST'),
                        'port' => env('MEMCACHED_PORT'),
                        'weight' => env('MEMCACHED_WEIGHT'),
                    ]
                ],
            ],
            'redis' => [
                'adapter' => 'Redis',
                'host' => env('REDIS_HOST'),
                'port' => env('REDIS_PORT'),
                'index' => env('REDIS_INDEX'),
                'persistent' => true,
            ],
            'file' => [
                'adapter' => 'Files',
            ],
        ],
        'prefix' => env('SESSION_PREFIX'),
        'uniqueId' => env('SESSION_UNIQUE_ID'),
        'lifetime' => env('SESSION_LIFETIME'),
    ]
];
