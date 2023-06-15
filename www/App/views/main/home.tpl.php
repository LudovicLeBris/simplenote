<main>
    <?php include __DIR__ . '/../partials/title.tpl.php' ?>
    <div class="actions">
        <a href="#">Ajouter une note</a>
    </div>
    
    <section class="cardContainer">
        <?php foreach($allNotes as $note): ?>
        <div class="card">
            <a href="<?= $router->generate('note-display', ['id' => $note->getId()]) ?>">
                <h2 class="card__title"><?= $note->getTitle() ?></h2>
                <p class="card__content"><?= (strlen($note->getContent())>150)? substr($note->getContent(), 0, 149).'...' : $note->getContent() ?></p>
                <p class="card__lastUpadated"><?= (is_null($note->getUpdated_at()))?'créé le' . $note->getCreated_at() : 'modifié le '. $note->getUpdated_at() ?></p>
            </a>
        </div>
        <?php endforeach ?>
    </section>
</main>