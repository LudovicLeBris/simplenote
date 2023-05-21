<?php $title = 'Ajout d\'une nouvelle note'; ?>

<?php ob_start(); ?>

<h1>Ajout d'une nouvelle note</h1>
<p class="note-menu"><a href="../index.php">Annuler</a></p>

<form class="update-form-menu" action="../index.php?action=addnote" method="POST">
    <div>
        <label for="title">Titre</label><br>
        <input type="text" name="title">
    </div>
    <div>
        <label for="content">Contenu de la note</label><br>
        <textarea name="content"cols="30" rows="20"></textarea>
    </div>
    <button type="submit">Enregistrer</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>