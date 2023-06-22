<main>
<?php include __DIR__ . '/../partials/title.tpl.php' ?>
    <div class="actions">
        <a href="<?= $router->generate('note-home') ?>">Retour</a>
        <a href="<?= $router->generate('user-edit', ['id' => $_SESSION['currentUserId']]) ?>">Modifier</a>
    </div>

    <section>
        <div>
            <p><?= $user->getFirstname() ?></p>
        </div>
        <div>
            <p><?= $user->getLastname() ?></p>
        </div>
        <div>
            <p><?= $user->getEmail() ?></p>
        </div>
    </section>

</main>