<?php $title = 'Détail de la note'; ?>

<?php ob_start(); ?>

<h1><?= htmlspecialchars($note->title) ?></h1>
<div class="note-menu">
    <ul>
        <li><a href="index.php">Retour</a></li>
        <li><a href="index.php?action=displayupdate&noteID=<?= urlencode($note->noteID) ?>">Editer</a></li>
        <li><a href="index.php?action=deletenote&noteID=<?= urlencode($note->noteID) ?>">Supprimer</a></li>
    </ul>
</div>

<div class="note-date">
    <p>Créé le : <?= htmlspecialchars($note->creationDATE) ?></p>
    <p>Dernière modification le : <?= htmlspecialchars($note->lastUpdateDATE) ?></p>
</div>
<div class="note-content">
    <p><?= htmlspecialchars($note->content) ?></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
