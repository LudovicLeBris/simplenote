<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('src/lib/database.php');
require_once('src/model/notes.php');

function delNote($userConnected, $noteID) 
{
    
    $noteRepository = new NoteRepository();
    $noteRepository->connection = new DatabaseConnection();

    $success = $noteRepository->deleteNote($userConnected, $noteID);
    if (!$success) {
        echo "erreur en base";
    } else {
        header('location: index.php');
    }

}