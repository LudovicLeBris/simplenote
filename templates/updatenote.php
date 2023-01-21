<?php $title = 'Modification de la note'; ?>

<?php ob_start(); ?>

<h1>Modification de la note</h1>
<a href="../index.php">Annuler</a><br><br>

<form action="../index.php?action=updatenote" method="POST">
    <div>
        <input type="hidden" name="noteID" value="<?= htmlspecialchars($note->noteID) ?>">
        <label for="title">Titre</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($note->title) ?>">
    </div>
    <div>
        <label for="content">Contenu de la note</label><br>
        <textarea name="content"cols="30" rows="30"><?= htmlspecialchars($note->content) ?></textarea>
    </div>
    <button type="submit">Enregistrer</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>