<?php

$router = $di->getRouter();

$router->add('/users/:action', [
    'controller' => 'users',
    'action' => 1,
]);

$router->add('/users/([0-9]+)', [
    'controller' => 'users',
    'action' => 'show',
    'userId' => 1,
]);

$router->add('/users/comment/add', [
    'controller' => 'user_page_comments',
    'action' => 'add',
]);

$router->add('/users/change/password', [
    'controller' => 'users',
    'action' => 'changePassword',
]);

$router->add('/posts/:action', [
    'controller' => 'pages',
    'action' => 1,
]);

$router->add('/posts/([0-9]+)', [
    'controller' => 'pages',
    'action' => 'show',
    'postId' => 1,
]);

$router->handle();
