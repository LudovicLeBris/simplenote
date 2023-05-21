<div class="header">

    <div class="app">
        <p>SIMPLE NOTE</p>
    </div>

    <div class="menu">
        <ul>
            <?php if (!isset($_SESSION['userID'])): ?>
                <li>Déconnecté</li>
            <?php else: ?>
                <li><?= $_SESSION['firstName'] ?> est connecté</li>
                <li><a href="../index.php?action=manageaccount">Gestion du compte</a></li>
                <li><a href="../index.php?action=logout">Se déconnecter</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>