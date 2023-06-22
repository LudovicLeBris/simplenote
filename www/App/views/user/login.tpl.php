<main>
    <?php include __DIR__ . '/../partials/title.tpl.php' ?>
    <div class="actions">
        <a href="<?= $router->generate('user-signup') ?>">Créer un compte</a>
    </div>

    <section class="loginForm">
        <form action="" method="POST">
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="exemple@mail.fr">
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <input type="submit" value="Se connnecter">
            </div>
        </form>
    </section>
</main>