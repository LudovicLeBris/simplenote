<?php

require_once('src/lib/database.php');
require_once('src/model/notes.php');

function notes() 
{
    $noteRepository = new NoteRepository();
    $noteRepository->connection = new DatabaseConnection();
    $notes = $noteRepository->displayNotes(1);
    
    require('templates/notes.php');
}
