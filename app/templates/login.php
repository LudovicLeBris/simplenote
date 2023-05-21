<?php $title = 'Page de connexion'; ?>

<?php ob_start(); ?>

<h1>Connexion</h1>
<div class="form-container">
    <form action="../index.php?action=submitlogin" method="post">
        <div class="form-login">
            <label for="email">Identifiant</label>
            <input type="email" name="email" id="email" placeholder="Insérer une adesse mail valide">
        </div>
        <div class="form-password">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Insérer votre mot de passe">
        </div>
        <button class="form-button" type="submit">Envoyer</button>
    </form>
</div>
<div class="signup">
    <p>Pas encore incrit ?</p>
    <p>Créer un <a href="templates/signin.php">compte</a></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>