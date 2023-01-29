<?php

function logout()
{
    session_destroy();

    require('templates/logout.php');
}