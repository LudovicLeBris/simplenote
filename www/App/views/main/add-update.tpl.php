<main>
    <?php include __DIR__ . '/../partials/title.tpl.php' ?>
    <div class="actions">
        <a href="<?= $router->generate('note-home') ?>">Retour</a>
        <?php if($note->getId()): ?><a href="<?= $router->generate('note-delete', ['id' => $note->getId()]) ?>">Supprimer la note</a><?php endif ?>
    </div>

    <section class="formContainer">
        <form action="" method="POST">
            <?php include __DIR__ . '/../partials/errors.tpl.php' ?>
            <div>
                <label for="title">Titre</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value=<?= ($note->getId())? $note->getTitle() : '' ?>
                >
            </div>
            <div>
                <label for="content">Contenu</label>
                <textarea 
                    name="content" 
                    id="content" 
                    cols="60" 
                    rows="22"><?= ($note->getId())? $note->getContent() : '' ?></textarea>
            </div>
            <div>
                <input type="submit" value="Enregistrer">
            </div>
        </form>
    </section>

</main>