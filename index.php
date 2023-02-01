<?php

session_start();

require_once('src/controllers/login.php');
require_once('src/controllers/logout.php');
require_once('src/controllers/signup.php');
require_once('src/controllers/displayaccount.php');
require_once('src/controllers/displayuser.php');
require_once('src/controllers/updateuser.php');
require_once('src/controllers/deleteuser.php');

require_once('src/controllers/notes.php');
require_once('src/controllers/note.php');
require_once('src/controllers/createnote.php');
require_once('src/controllers/deletenote.php');
require_once('src/controllers/displayupdate.php');
require_once('src/controllers/updatenote.php');

if (!isset($_SESSION['userID']))
{
    if (isset($_GET['action']) && $_GET['action'] !== '') 
    {
        switch ($_GET['action'])
        {
            case 'submitlogin':
                login($_POST);
                break;

            case 'createuser':
                createUser($_POST);
                break;
                
            default:
                header(location: 'templates/login.php');
                break;
        }
    }
    
    require('templates/login.php');
}
elseif (isset($_GET['action']) && $_GET['action'] !== '')
{
    switch ($_GET['action'])
    {
        case 'logout':
            logout();
            break;

        case 'manageaccount':
            displayAccount();
            break;

        case 'displayuser':
            displayUser($_SESSION['email']);
            break;

        case 'updateuser':
            updateUser($_POST);
            break;

        case 'deleteuser':
            deleteUser($_SESSION['userID']);
            break;

        case 'createnote':
            addNote($_POST);
            break;
            
        case 'deletenote':
            if (isset($_GET['noteID']) && $_GET['noteID'] > 0) {
                $noteID = $_GET['noteID'];
    
            delNote($_SESSION['userID'], $noteID);
            } else {
                echo 'ID erroné';
            }
            break;

        case 'displayupdate':
            if (isset($_GET['noteID']) && $_GET['noteID'] > 0) {
                $noteID = $_GET['noteID'];
                
                displayupdate($_SESSION['userID'], $noteID);
                
            } else {
                echo 'ID erroné';
            }
            break;
            
        case 'updatenote':
            update($_POST);
            break;
            
        case 'note':
            if (isset($_GET['noteID']) && $_GET['noteID'] > 0) {
                $noteID = $_GET['noteID'];
        
                note($_SESSION['userID'], $noteID);
            } else {
                echo "ID erroné";
            }
            break;

        default:
            echo "Erreur 404";
            break;
    }

} else {
    notes();
}
