<?php
if (isset($_SESSION['currentUser'])):
?>

<nav class="navbar">
    <div class="brand">
        <a href="<?= $router->generate('note-home') ?>">Simplenote</a>
    </div>
    <div class="menu">
        <ul>
            <?php if(false): ?>
            <li>Déconnecté</li>
            <?php else: ?>
            <li><?= $_SESSION['currentUser']->getFirstname() ?> est connecté</li>
            <li><a href="<?= $router->generate('user-account', ['id' => $_SESSION['currentUserId']]) ?>">Gestion du compte</a></li>
            <li><a href="<?= $router->generate('user-logout') ?>">Se déconnecter</a></li>
            <?php endif ?>
        </ul>
    </div>
</nav>

<?php endif ?>