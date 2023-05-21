<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('src/lib/database.php');
require_once('src/model/notes.php');

function notes() 
{
    $noteRepository = new NoteRepository();
    $noteRepository->connection = new DatabaseConnection();
    $notes = $noteRepository->displayNotes($_SESSION['userID']);
    
    require('templates/notes.php');
}
