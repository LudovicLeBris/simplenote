<?php

namespace App\Controllers;

abstract class CoreController
{   
    /**
     * App general's router
     *
     * @var Altorouter
     */
    private object $router;

    /**
     * Current object route name from general router
     *
     * @var string
     */
    private string $routeName;

    public function __construct($router)
    {
        $this->router = $router;
        $this->routeName = $this->router->match()['name'];
    }

    /**
     * Map an readable string for pages titles
     *
     * @return string
     */
    protected function currentPageTitle()
    {
        $mapping = [
            'note-home' => 'Mes notes',
            'note-display' => 'Détail de la note',
            'note-add' => 'Création d\'une note',
            'note-create' => 'Création d\'une note',
            'note-update' => 'Modification de la note'
        ];

        return $mapping[$this->routeName];
    }

    /**
     * adds a flash message to error handling
     *
     * @param string $message
     * @param string $type
     * @return void
     */
    protected function addFlashMessage($message, $type = 'success'): void
    {
        
    }

    /**
     * retrieves all flash messages for display on pages
     *
     * @return void
     */
    protected function getFlashMessage()
    {

    }

    /**
     * Redirect method
     *
     * @param string $routeName
     * @param array $routeParam
     * @return void
     */
    protected function redirect($routeName, $routeParam = []): void
    {
        header("Location: ". $this->router->generate($routeName, $routeParam));
        exit();
    }

    /**
     * displas HTML code based on views
     *
     * @param string $viewName
     * @param array $viewData
     * @return void
     */
    protected function show(string $viewName, array $viewData = []):void
    {
        $router = $this->router;

        $viewData['currentPage'] = $viewName;
        $viewData['currentPageTitle'] = $this->currentPageTitle();
        $viewData['assetBaseUri'] = $_SERVER['BASE_URI'] . 'public/assets/';
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        dump($viewData);

        extract($viewData);

        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }
}