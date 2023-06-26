<main>
    <?php include __DIR__ . '/../partials/title.tpl.php' ?>
    <div class="actions">
        <a href="<?= $router->generate('admin-list') ?>">Retour</a>
        <a href="<?= $router->generate('user-delete', ['id' => $user->getId()]) ?>">Supprimer le compte</a>
    </div>

    <section class="signupForm">
        <form action="" method="POST">
            <?php include __DIR__ . '/../partials/errors.tpl.php' ?>
            <div>
                <p>Prénom : <span><?= $user->getFirstname() ?></span></p>
            </div>
            <div>
                <p>Nom de famille : <span><?= $user->getLastname() ?></span></p>
            </div>
            <div>
                <p>E-mail : <span><?= $user->getEmail() ?></span></p>
            </div>
            <div>
                <label for="role">role</label>
                <select name="role" id="role">
                    <?php foreach($roles as $role): ?>
                    <option value="<?= $role->getId() ?>" <?= ($role->getId() === $user->getRoleId())? 'selected' : '' ?>>
                        <?= $role->getName() ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <input type="hidden" name="tokenCsrf" value="<?= $tokenCsrf ?>">
                <input type="submit" value="Modifier">
            </div>
        </form>
    </section>


</main>