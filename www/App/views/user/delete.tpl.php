<main>
    <?php include __DIR__ . '/../partials/title.tpl.php' ?>
    <div class="actions">
        <a href="<?= $router->generate('user-account', ['id' => $user->getId()]) ?>">Annuler</a>
    </div>

    <section>
        <form action="" method="post">
            <div>
                <p>Êtes vous sûr de vouloir supprimer votre compte utilisateur</p>
                <p>Toutes les données liées à ce compte seront perdus</p>
            </div>
            <div>
                <button><a href="<?= $router->generate('user-account', ['id' => $user->getId()]) ?>">Non, je me suis trompé, revenir en arrière</a></button>
                <input type="hidden" name="tokenCsrf" value="<?= $tokenCsrf ?>">
                <input type="submit" value="Oui, je supprime">
            </div>
        </form>
    </section>
</main>