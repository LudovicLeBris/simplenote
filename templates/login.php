<?php $title = 'Page de connexion'; ?>

<?php ob_start(); ?>

<h1>Connexion</h1>
<div>
    <form action="../index.php?action=submitlogin" method="post">
        <label for="email">Identifiant</label>
        <input type="email" name="email" id="email" placeholder="Insérer une adesse mail valide">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <button type="submit">Envoyer</button>
    </form>
</div>
<div>
    <p>Créer un <a href="templates/signin.php">compte</a></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>