<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');

require BASE_PATH . '/vendor/autoload.php';


/*
 * Start debug
 */
$debug = new \Phalcon\Debug(new \Phalcon\Di\FactoryDefault());
//$debug->listen();

/*
 * ---------------------------------------------------------------
 * Handle Application
 * ---------------------------------------------------------------
 *
 */
$core = new \App\App();

$core->handle();
