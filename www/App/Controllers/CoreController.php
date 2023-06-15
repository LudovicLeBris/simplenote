<?php

namespace App\Controllers;

abstract class CoreController
{   
    private $router;
    private $routeName;

    public function __construct($router)
    {
        $this->router = $router;
        $this->routeName = $this->router->match()['name'];

    }

    protected function show(string $viewName, array $viewData = []):void
    {
        $router = $this->router;

        $viewData['currentPage'] = $viewName;
        $viewData['assetBaseUri'] = $_SERVER['BASE_URI'] . 'public/assets/';
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        dump($viewData);

        extract($viewData);

        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }
}