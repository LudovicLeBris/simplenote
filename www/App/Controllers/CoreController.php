<?php

namespace App\Controllers;

class CoreController
{
    protected function show(string $viewName, array $viewData = []):void
    {
        global $router;

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