<?php $title = 'Modification du compte'; ?>

<?php ob_start(); ?>

<h1>Modification du compte</h1>
<a href="../index.php?action=manageaccount">Annuler</a><br><br>

<form action="../index.php?action=updateuser" method="POST">
    <p>Identifiant : <?= $user->email ?></p>
    <div>
        <input type="hidden" name="userID" value="<?= htmlspecialchars($user->userID) ?>">
        <label for="firstName">Prénom</label>
        <input type="text" name="firstName" value="<?= htmlspecialchars($user->firstName) ?>">
    </div>
    <div>
        <label for="lastName">Nom de famille</label>
        <input type="text" name="lastName" value="<?= htmlspecialchars($user->lastName) ?>">
    </div>
    <button type="submit">Enregister</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>