<?php

require_once __DIR__ . '/vendor/autoload.php';

session_start();

$router = new AltoRouter();

if (array_key_exists('BASE_URI', $_SERVER)) {
    $router->setBasePath($_SERVER['BASE_URI']);
} else {
    $_SERVER['BASE_URI'] = '/';
}

/**********************
******* Router ********
***********************/

// NoteContoller routes

$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => 'App\Controllers\NoteController'
    ],
    'note-home'
);

$router->map(
    'GET',
    '/note/[i:id]',
    [
        'method' => 'display',
        'controller' => 'App\Controllers\NoteController'
    ],
    'note-display'
);

$router->map(
    'GET',
    '/note/add',
    [
        'method' => 'add',
        'controller' => 'App\Controllers\NoteController'
    ],
    'note-add'
);

$router->map(
    'GET',
    '/note/update/[i:id]',
    [
        'method' => 'update',
        'controller' => 'App\Controllers\NoteController'
    ],
    'note-update'
);

$router->map(
    'POST',
    '/note/update/[i:id]',
    [
        'method' => 'updatePost',
        'controller' => 'App\Controllers\NoteController'
    ],
    'note-update-post'
);

// ErrorController routes


/**********************
****** Dispatcher *****
***********************/

$match = $router->match();

$dispatcher = new Dispatcher($match, ['method' => 'err404', 'controller' => '\App\Controllers\ErrorController']);

$dispatcher->dispatch();