<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="public/css/main.css">
        <title><?= $title ?></title>
    </head>

    <body>

        <header class="header">
            
            <div class="app">
                <p>SIMPLE NOTE</p>
            </div>

            <nav class="menu">
                <ul>
                    <?php if (!isset($_SESSION['userID'])): ?>
                    <li>Déconnecté</li>
                    <?php else: ?>
                    <li><?= $_SESSION['firstName'] ?> est connecté</li>
                    <li><a href="#">Gestion du compte</a></li>
                    <li><a href="#">Se déconnecter</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

        </header>