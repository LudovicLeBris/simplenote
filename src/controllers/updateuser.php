<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('src/lib/database.php');
require_once('src/model/users.php');

function updateUser(array $input)
{
    $userID = $input['userID'];

    $firstName = null;
    $lastName = null;

    if (!empty($input['firstName']) && !empty($input['lastName']))
    {
        $firstName = $input['firstName'];
        $lastName = $input['lastName'];
    } else {
        echo "les données du formulaires sont invalides.";
    }

    $userRepository = new UserRespository();
    $userRepository->connection = new DatabaseConnection();

    $success = $userRepository->updateUser($userID, $firstName, $lastName);
    
    if (!$success)
    {
        echo "Erreur d'entrée en base";
    } else {
        header('location: index.php?action=manageaccount');
    }
}