<?php $title = 'Ajout d\'une nouvelle note'; ?>

<?php ob_start(); ?>

<h1>Ajout d'une nouvelle note</h1>
<a href="../index.php">Annuler</a><br><br>

<form action="../index.php?action=createnote" method="POST">
    <div>
        <label for="title">Titre</label><br>
        <input type="text" name="title">
    </div>
    <div>
        <label for="content">Contenu de la note</label><br>
        <textarea name="content"cols="30" rows="30"></textarea>
    </div>
    <button type="submit">Enregistrer</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>