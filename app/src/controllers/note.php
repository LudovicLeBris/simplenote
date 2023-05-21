<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('src/lib/database.php');
require_once('src/model/notes.php');

function note($userConnected, $noteID) 
{
    $noteRepository = new NoteRepository();
    $noteRepository->connection = new DatabaseConnection();
    
    $note = $noteRepository->displayNote($userConnected, $noteID);
    // $note = displayNote($userConnected, $noteID);

    require('templates/note.php');
}