<main>
<?php include __DIR__ . '/../partials/title.tpl.php' ?>
    <div class="actions">
        <a href="<?= $router->generate('note-home') ?>">retour</a>
    </div>

    <section class='listContainer'>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>E-mail</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user->getId() ?></td>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= $user->getFirstname() ?></td>
                    <td><?= $user->getLastname() ?></td>
                    <td>Edit.</td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </section>
</main>