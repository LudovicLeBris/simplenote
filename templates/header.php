<div>
    <p>SIMPLE NOTE</p>
</div>

<div>
    <?php if (!isset($_SESSION['userID'])): ?>
        <p>Déconnecté</p>
    <?php else: ?>
        <p><?= $_SESSION['firstName'] ?> est connecté</p>
        <p><a href="../index.php?action=manageaccount">Gestion du compte</a></p>
        <p><a href="../index.php?action=logout">Se déconnecter</a></p>
    <?php endif; ?>
</div>
