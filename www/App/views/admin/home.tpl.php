<main>
    <?php include __DIR__ . '/../partials/title.tpl.php' ?>
    <div class="actions">
        <a href="<?= $router->generate('note-home') ?>">Retour</a>
    </div>

    <section>
        <div>
            <h3>Nombres d'utilisateurs</h3>
            <div>
                <p>Il y a actuellement <span><?= $totalUsersCount ?></span> utilisateurs enregistrés</p>
                <p><a href="<?= $router->generate('admin-list') ?>">Liste des utilisateurs</a></p>
            </div>
        </div>
    </section>
</main>