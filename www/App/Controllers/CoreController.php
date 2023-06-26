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

    public function __construct(object $router)
    {
        $this->router = $router;
        $this->routeName = $this->router->match()['name'];

        $this->checkSecurity();
    }

    /**
     * Security global management
     *
     * @return void
     */
    private function checkSecurity(): void
    {
        $configData = parse_ini_file(__DIR__ . '/../security.ini', true);

        $this->checkACL(isset($configData['ACL'])? $configData['ACL'] : []);
        $this->checkCSRF(isset($configData['CSRF'])? $configData['CSRF'] : []);
    }

    /**
     * Access management
     *
     * @param array $acl
     * @return void
     */
    private function checkACL($acl): void
    {
        if(array_key_exists($this->routeName, $acl)){
            $roles = explode(' ', $acl[$this->routeName]);
            $this->checkAuthorization($roles);
        }
    }

    /**
     * CSRF token management
     *
     * @param array $csrfRoutes
     * @return void
     */
    private function checkCSRF($csrfRoutes): void
    {
        $csrfTokenPost = isset($csrfRoutes['POST'])? explode(' ', $csrfRoutes['POST']):[];
        $csrfTokenGet = isset($csrfRoutes['GET'])? explode(' ', $csrfRoutes['GET']):[];

        $tokenCsrdProtectedRoutes = false;
        if(in_array($this->routeName, $csrfTokenPost)){
            $tokenCsrfUser = filter_input(INPUT_POST, 'tokenCsrf');
            $tokenCsrdProtectedRoutes = true;
        }
        if(in_array($this->routeName, $csrfTokenGet)){
            $tokenCsrfUser = filter_input(INPUT_GET, 'tokenCsrf');
            $tokenCsrdProtectedRoutes = true;
        }
        if($tokenCsrdProtectedRoutes){
            $tokenCsrfSession = isset($_SESSION['tokenCsrf'])? $_SESSION['tokenCsrf'] : '';

            if($tokenCsrfUser !== $tokenCsrfSession || empty($tokenCsrfSession)){
                $this->redirect('error-err403');
            }
        }

        $tokenCsrf = bin2hex(random_bytes(32));
        $_SESSION['tokenCsrf'] = $tokenCsrf;
    }

    /**
     * Check if User has right to login to the app
     *
     * @param array $roles
     * @return boolean|null
     */
    public function checkAuthorization($roles = []): ?bool
    {
        if(isset($_SESSION['currentUser'])){
            $user = $_SESSION['currentUser'];
            $role = $user->getRoleId();
            
            if(in_array($role, $roles)){
                return true;
            }

            $this->redirect('error-err403');
        }

        $this->redirect('user-login');
    }

    /**
     * Map an readable string for pages titles
     *
     * @return string
     */
    protected function currentPageTitle(): string
    {
        $mapping = [
            'note-home' => 'Mes notes',
            'note-display' => 'Détail de la note',
            'note-add' => 'Création d\'une note',
            'note-create' => 'Création d\'une note',
            'note-update' => 'Modification de la note',
            'user-login' => 'Page de connexion',
            'user-login-post' => 'Page de connexion',
            'user-signup' => 'Création de compte',
            'user-signup-post' => 'Création de compte',
            'user-edit' => 'Edition du compte utilisateur',
            'user-edit-post' => 'Edition du compte utilisateur',
            'user-delete' => 'Suppression du compte utilisateur',
            'user-delete-post' => 'Suppression du compte utilisateur',
            'user-account' => 'Détail compte utilisateur',
            'error-err403' => 'Accès non autorisé',
            'error-err404' => 'Page non trouvée',
            'admin-home' => 'Administration du site',
            'admin-list' => 'Liste des utilisateurs',
            'admin-edit' => 'Edition de l\'utilisateurs',
            'admin-edit-post' => 'Edition de l\'utilisateurs',
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
    protected function addFlashMessage(string $message, string $type = 'success'): void
    {
        $messagesList = isset($_SESSION['flashMessages'])? $_SESSION['flashMessages'] : [];
        $messagesList[] = ['message' => $message, 'type' => $type];
        $_SESSION['flashMessages'] = $messagesList;
    }

    /**
     * retrieves all flash messages for display on pages
     *
     * @return array
     */
    protected function getFlashMessage(): array
    {
        $messagesList = [];
        if(isset($_SESSION['flashMessages'])){
            $messagesList = $_SESSION['flashMessages'];
            unset($_SESSION['flashMessages']);
        }
        return $messagesList;
    }

    /**
     * Redirect method
     *
     * @param string $routeName
     * @param array $routeParam
     * @return void
     */
    protected function redirect(string $routeName, array $routeParam = []): void
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
        $viewData['tokenCsrf'] = $_SESSION['tokenCsrf'];
        $viewData['flashMessages'] = $this->getFlashMessage();

        // dump($viewData);
        extract($viewData);

        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }
}