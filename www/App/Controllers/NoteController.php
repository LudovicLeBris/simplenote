<?php

namespace App\Controllers;

class NoteController extends CoreController
{
    public function home()
    {
        $this->show('main/home');
    }

    public function add()
    {
        $this->show('main/add');
    }

}