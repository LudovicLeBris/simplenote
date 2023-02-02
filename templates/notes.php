<?php $title = "Mes notes"; ?>

<?php ob_start(); ?>

    <h1>Mes notes</h1>
    <a href="index.php?action=createnote">Ajouter une note</a>
    <?php foreach($notes as $note) : ?>
        <div>
            <h3><?= htmlspecialchars($note->title) ?></h3>
            <p>Créé le : <?= htmlspecialchars($note->creationDATE) ?></p>
            <p>Dernière modification le : <?= htmlspecialchars($note->lastUpdateDATE) ?></p>
            <div>
                <p><?= htmlspecialchars($note->content) ?></p>
            </div>
            <a href="index.php?action=note&noteID=<?= urlencode($note->noteID) ?>">Editer</a>
            <hr>
        </div>
    <?php endforeach ?>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>