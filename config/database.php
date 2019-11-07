<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

use function App\Helpers\env;

return [
    'database' => [
        'driver' => env('DB_ADAPTER', 'mysql'),

        'drivers' => [
            'mysql' => [
                'adapter' => 'Mysql',
                'host' => env('DB_HOST'),
                'port' => env('DB_PORT'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'dbname' => env('DB_DATABASE'),
                'charset' => env('DB_CHARSET'),
                'options' => [
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_STRINGIFY_FETCHES => false
                ]
            ],

            'postgresql' => [
                'adapter' => 'Postgresql',
                'host' => env('DB_HOST'),
                'port' => env('DB_PORT'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'dbname' => env('DB_DATABASE'),
                'charset' => env('DB_CHARSET'),
                'schema' => env('DB_SCHEMA')
            ],
        ]
    ]
];
