<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('src/lib/database.php');
require_once('src/model/notes.php');

function addNote (array $input)
{
    
    $title = null;
    $content = null;
    if (!empty($input['title']) && !empty($input['content'])) {
        $title = $input['title'];
        $content = $input['content'];
    } else {
        echo 'les données du formulaires sont invalides';
    }

    $noteRepository = new NoteRepository();
    $noteRepository->connection = new DatabaseConnection();

    $success = $noteRepository->createNote($_SESSION['userID'], $title, $content);
    if (!$success) {
        echo "Erreur d'entrèe en base";
    } else {
        header('location: index.php');
    }
}
