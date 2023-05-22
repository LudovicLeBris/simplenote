<?php

class MainController {

    private function show($viewName, $viewData = []) {
        require __DIR__ . '/../views/header.tpl.php';
        require __DIR__ . '/../views/footer.tpl.php';

    }

    public function home() {
        $this->show('home');
    }

}