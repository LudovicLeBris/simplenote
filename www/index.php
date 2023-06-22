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
    'POST',
    '/note/add',
    [
        'method' => 'create',
        'controller' => 'App\Controllers\NoteController'
    ],
    'note-create'
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

$router->map(
    'GET',
    '/note/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => 'App\Controllers\NoteController'
    ],
    'note-delete'
);

// UserController routes

$router->map(
    'GET',
    '/login',
    [
        'method' => 'login',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-login'
);

$router->map(
    'POST',
    '/login',
    [
        'method' => 'loginPost',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-login-post'
);

$router->map(
    'GET',
    '/signup',
    [
        'method' => 'signup',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-signup'
);

$router->map(
    'POST',
    '/signup',
    [
        'method' => 'signupPost',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-signup-post'
);

$router->map(
    'GET',
    '/users',
    [
        'method' => 'list',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-list'
);

$router->map(
    'GET',
    '/users/account/[i:id]',
    [
        'method' => 'account',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-account'
);

$router->map(
    'GET',
    '/users/edit/[i:id]',
    [
        'method' => 'edit',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-edit'
);

$router->map(
    'POST',
    '/users/edit/[i:id]',
    [
        'method' => 'editPost',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-edit-post'
);

$router->map(
    'GET',
    '/users/delete/[i:id]',
    [
        'method' => 'delete',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-delete'
);

$router->map(
    'POST',
    '/users/delete/[i:id]',
    [
        'method' => 'deletePost',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-delete-post'
);

$router->map(
    'GET',
    '/logout',
    [
        'method' => 'logout',
        'controller' => 'App\Controllers\UserController'
    ],
    'user-logout'
);

// ErrorController routes

$router->map(
    'GET',
    '/Error403',
    [
        'method' => 'err403',
        'controller' => 'App\Controllers\ErrorController'
    ],
    'error-err403'
);


/**********************
****** Dispatcher *****
***********************/

$match = $router->match();

$dispatcher = new Dispatcher($match, ['method' => 'err404', 'controller' => '\App\Controllers\ErrorController']);

$dispatcher->setControllersArguments($router);

$dispatcher->dispatch();