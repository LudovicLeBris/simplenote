<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('src/lib/database.php');
require_once('src/model/users.php');

function displayUser($userEmail)
{
    $userRepository = new UserRespository();
    $userRepository->connection = new DatabaseConnection();

    $user = $userRepository->getUser($userEmail);

    require('templates/updateuser.php');
}