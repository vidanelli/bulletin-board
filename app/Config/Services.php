<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Carbon\Carbon;
use League\Flysystem\Adapter\Local;
use League\Flysystem\{Filesystem, MountManager};
use League\Flysystem\Plugin\ListFiles;
use Phalcon\Http\Response\Cookies;
use BulletinBoardProject\Services\{AuthService, TokenService};
use Intervention\Image\ImageManager;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ]);

            return $volt;
        }//,
        //'.phtml' => PhpEngine::class

    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Register datetime service
 */
$di->setShared('datetime', function () {
    return new Carbon();
});

/**
* Register filesystem service
*/
$di->setShared('filesystem', function () {
    $storage = new Local(BASE_PATH . '/public/storage/');
    $tmp = new Local(BASE_PATH . '/public/tmp/');

    $manager = new MountManager();
    $manager->addPlugin(new ListFiles());
    $manager->mountFilesystem('storage', new Filesystem($storage))
        ->mountFilesystem('tmp', new Filesystem($tmp));

    return $manager;
});

/**
* Register cookies service
*/
$di->setShared('cookies', function () {
    $cookies = new Cookies();
    $cookies->useEncryption(false);

    return $cookies;
});

/**
 * Register auth service
 */
$di->setShared('auth', function () {
    $auth = new AuthService(new TokenService());

    return $auth;
});

/**
 * Register imagemanager service
 */
$di->setShared('imagemanager', function () {
    $imagemanager = new ImageManager(array('driver' => 'imagick'));

    return $imagemanager;
});
