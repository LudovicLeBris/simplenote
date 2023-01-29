<?php $title = 'Détail de la note'; ?>

<?php ob_start(); ?>

<h1>Détail de la note</h1>
<a href="index.php">Retour</a><br><br>
<div>
    <a href="index.php?action=displayupdate&noteID=<?= urlencode($note->noteID) ?>">Editer</a>
    <a href="index.php?action=deletenote&noteID=<?= urlencode($note->noteID) ?>">Supprimer</a>
</div>

<div>
    <h3><?= htmlspecialchars($note->title) ?></h3>
    <p>Créé le : <?= htmlspecialchars($note->creationDATE) ?></p>
    <p>Dernière modification le : <?= htmlspecialchars($note->lastUpdateDATE) ?></p>
    <div>
        <p><?= htmlspecialchars($note->content) ?></p>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
