<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

use function BulletinBoardProject\Helpers\env;

return [
    'view' => [

        'dir' => realpath(BASE_PATH . DIRECTORY_SEPARATOR . env('APP_VIEWS_DIR')),


        'volt' => [
            'compiledPath' => BASE_PATH . DIRECTORY_SEPARATOR . env('VOLT_CACHE_DIR'),
            'compiledSeparator' => '_',
            'compiledExtension' => '.phtml',
            'compileAlways' => env('VOLT_COMPILE_ALWAYS', false)
        ]
    ]
];
