<?php

namespace App\Controllers;

class ErrorController extends CoreController
{
    public function err404()
    {
        header('HTTP/1.0 404 Not found');

        $this->show('error/err404');
    }
}