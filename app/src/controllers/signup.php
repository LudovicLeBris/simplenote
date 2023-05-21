<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('src/lib/database.php');
require_once('src/model/users.php');

function createUser(array $input)
{
    $email = null;
    $password = null;
    $firstName = null;

    if (!empty($input['email']) && !empty($input['password']) && !empty($input['firstName']))
    {
        $email = $input['email'];
        $password = $input['password'];
        $firstName = $input['firstName'];
    } else {
        echo "Les données du formulaires sont invalides";
    }
    
    $lastName = $input['lastName'];

    $userRepository = new UserRespository();
    $userRepository->connection = new DatabaseConnection();

    $success = $userRepository->createUser($firstName, $lastName, $email, $password);
    if (!$success) {
        echo "Erreur d'entrée en base";
    } else {
        header('location: index.php');
    }

}