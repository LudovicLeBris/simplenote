<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('src/lib/database.php');
require_once('src/model/notes.php');

function deleteUser($userID)
{
    $userRepository = new UserRespository();
    $userRepository->connection = new DatabaseConnection();

    $success = $userRepository->deleteUser($userID);

    if (!$success)
    {
        echo "erreur en base";
    } else {
        echo '<script>alert("Utilisateur supprimée");</script>';
        session_destroy();
        header('location: index.php');
    }

}