<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Helpers;

use Phalcon\Di;
use Phalcon\Text;

if (!function_exists('App\Helpers\uncamelize')) {
    /**
     * @param string $text
     * @param string|null $delimiter
     * @return string
     */
    function uncamelize(string $text, $delimiter = null): string
    {
        return Text::uncamelize($text, $delimiter);
    }
}

if (!function_exists('App\Helpers\camelize')) {
    /**
     * @param string $text
     * @param string|null $delimiter
     * @return string
     */
    function camelize(string $text, $delimiter = null): string
    {
        return Text::camelize($text, $delimiter);
    }
}

if (!function_exists('App\Helpers\container')) {
    /**
     * @param string|null $service
     * @param array $params
     * @return \Phalcon\DiInterface|mixed
     */
    function container($service = null, array $params = [])
    {
        $di = Di::getDefault();
        $args = func_get_args();

        if (empty($args)) {
            return $di;
        }

        return $di->get($service, $params);
    }
}

if (!function_exists('App\Helpers\appPath')) {
    /**
     * @param string $path
     * @return string
     */
    function appPath(string $path = ''): string
    {
        return realpath(__DIR__ . '/../../' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
    }
}

if (!function_exists('App\Helpers\configPath')) {
    /**
     * @param string $path
     * @return string
     */
    function configPath(string $path = ''): string
    {
        return appPath(env('APP_CONFIG_DIR', 'config')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('App\Helpers\systemPath')) {

    function systemPath(string $path = ''): string
    {
        return appPath(env('APP_SYSTEM_DIR', 'system')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('App\Helpers\storagePath')) {

    function storagePath(string $path = ''): string
    {
        return appPath(env('APP_STORAGE_DIR', 'storage')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('App\Helpers\tmpPath')) {

    function tmpPath(string $path = ''): string
    {
        return appPath(env('APP_TMP_DIR', 'tmp')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('App\Helpers\env')) {
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
