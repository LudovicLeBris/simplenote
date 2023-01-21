<?php

require_once('src/controllers/notes.php');
require_once('src/controllers/note.php');
require_once('src/controllers/createnote.php');
require_once('src/controllers/deletenote.php');
require_once('src/controllers/displayupdate.php');
require_once('src/controllers/updatenote.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
    if ($_GET['action'] === 'note') {

        if (isset($_GET['noteID']) && $_GET['noteID'] > 0) {
            $noteID = $_GET['noteID'];

            note("1", $noteID);
        } else {
            echo "ID erroné";
        }

    } elseif ($_GET['action'] === 'createnote') {
        addNote($_POST);

    } elseif ($_GET['action'] === 'deletenote') {
        if (isset($_GET['noteID']) && $_GET['noteID'] > 0) {
            $noteID = $_GET['noteID'];

            delNote(1, $noteID);
        } else {
            echo 'ID erroné';
        }

    } elseif ($_GET['action'] === 'displayupdate') {
        if (isset($_GET['noteID']) && $_GET['noteID'] > 0) {
            $noteID = $_GET['noteID'];
            
            displayupdate("1", $noteID);

        } else {
            echo 'ID erroné';
        }

    } elseif ($_GET['action'] === 'updatenote') {
        update($_POST);
        
    } else {

        echo "Erreur 404";
    }
    
} else {
    notes();
}
