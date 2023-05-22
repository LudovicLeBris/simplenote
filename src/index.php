<?php

require_once __DIR__ . '/Controllers/MainContoller.php';

// $_GET control
if (isset($_GET['_url'])) {
    $pageName = $_GET['_url'];
} else {
    $pageName = '/';
}

// Pages defintions
$pages = [
    '/' => [
        'action' => 'home',
        'controller' => 'MainController',
    ],
];

// Dispatcher

if (isset($pages[$pageName])) {
    $routeData = $pages[$pageName];
    $controlerToUse = $routeData['controller'];
    $methodToUse = $routeData['action'];
} else {
    $controlerToUse = 'MainController';
    $methodToUse = 'home';
}

$controler = new $controlerToUse();
$controler->$methodToUse();

// End dispatcher