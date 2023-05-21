<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('src/lib/database.php');
require_once('src/model/users.php');

function login($array)
{
    $userRepository = new UserRespository();
    $userRepository->connection = new DatabaseConnection();
    
    $email = $array['email'];
    $password = $array['password'];

    $userExist = $userRepository->userExist($email);

    if (!$userRepository->userExist($email)) {
        echo "L'utilisateur n'existe pas";
    } elseif (!$userRepository->checkPassword($email, $password))
    {
        echo "Le mot de passe ne correspond pas";
    } else 
    {
        $user = $userRepository->getUser($email, $password);
    
        $_SESSION['userID'] = $user->userID;
        $_SESSION['firstName'] = $user->firstName;
        $_SESSION['lastName'] = $user->lastName;
        $_SESSION['email'] = $user->email;

        header('location: index.php');
    }

    
}