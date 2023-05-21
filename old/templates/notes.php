<?php $title = "Mes notes"; ?>

<?php ob_start(); ?>

    <h1>Mes notes</h1>
    <div class="createnote">
        <a href="index.php?action=createnote">Ajouter une note</a>
    </div>
    <div class="notecards">
        <?php foreach($notes as $note) : ?>
        <a class="note-editLink" href="index.php?action=note&noteID=<?= urlencode($note->noteID) ?>">
            <div class="notecard">
                <h3 class ="notetitle"><?= htmlspecialchars($note->title) ?></h3>
                <div class="note-content-container">
                    <p class="note-content-preview"><?= htmlspecialchars($note->content) ?></p>
                </div>
                <p class="notes-date">Dernière modification le : <?= htmlspecialchars($note->lastUpdateDATE) ?></p>
                <p class="notes-date">Créé le : <?= htmlspecialchars($note->creationDATE) ?></p>
                <div class="note-editLink">
                </div>
                <!-- <hr> -->
            </div>
        </a>
        <?php endforeach ?>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>