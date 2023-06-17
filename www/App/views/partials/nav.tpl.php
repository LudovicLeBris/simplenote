<nav class="navbar">
    <div class="brand">
        <a href="<?= $router->generate('note-home') ?>">Simplenote</a>
    </div>
    <div class="menu">
        <ul>
            <?php if(false): ?>
            <li>Déconnecté</li>
            <?php else: ?>
            <li>User est connecté</li>
            <li>Gestion du compte</li>
            <li>Se déconnecter</li>
            <?php endif ?>
        </ul>
    </div>
</nav>