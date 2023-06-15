<?php

namespace App\Controllers;
use App\Models\Note;

class NoteController extends CoreController

{
    public function home()
    {
        $this->show('main/home', [
            'allNotes' => Note::findAll()
        ]);
    }

    public function display($id)
    {
        $this->show('main/add', [
            'note' => Note::find($id)
        ]);
    }

    public function add()
    {
        $this->show('main/add');
    }

}