<?php $title = 'Gestion du compte'; ?>

<?php ob_start(); ?>

<h1>Gestion du compte</h1>

<div class="display-account-menu">
    <ul>
        <li><a href="index.php">Retour</a></li>
        <li><a href="index.php?action=displayuser">Modifier données</a></li>
        <li><a href="index.php?action=deleteuser">Supprimer compte</a></li>
    </ul>
</div>
<div class="display-account">
    <p>Identifiant : <?= $user->email ?></p>
    <p>Prénom : <?= $user->firstName ?></p>
    <p>Nom de famille : <?= $user->lastName ?></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>