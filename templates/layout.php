<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="public/style/main.css">
        <title><?= $title ?></title>
    </head>

    <body>

        <nav>
            <?php require('header.php'); ?>
        </nav>

        <main>
            <?= $content ?>
        </main>

        <footer>
            <?php require('footer.php'); ?>
        </footer>

    </body>
</html>