<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Helpers;

if (!function_exists('BulletinBoardProject\Helpers\appPath')) {
    /**
     * @param string $path
     * @return string
     */
    function appPath(string $path = ''): string
    {
        return realpath(__DIR__ . '/../../' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
    }
}

if (!function_exists('BulletinBoardProject\Helpers\configPath')) {
    /**
     * @param string $path
     * @return string
     */
    function configPath(string $path = ''): string
    {
        return appPath(env('APP_CONFIG_DIR', 'config')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('BulletinBoardProject\Helpers\systemPath')) {

    function systemPath(string $path = ''): string
    {
        return appPath(env('APP_SYSTEM_DIR', 'system')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('BulletinBoardProject\Helpers\storagePath')) {

    function storagePath(string $path = ''): string
    {
        return appPath(env('APP_STORAGE_DIR', 'storage')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('BulletinBoardProject\Helpers\tmpPath')) {

    function tmpPath(string $path = ''): string
    {
        return appPath(env('APP_TMP_DIR', 'tmp')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('BulletinBoardProject\Helpers\env')) {
    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function env(string $key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
                return true;
            case 'false':
                return false;
            case 'empty':
                return '';
            case 'null':
                return null;
        }

        return $value;
    }
}
