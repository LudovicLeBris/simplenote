<main>
    <?php include __DIR__ . '/../partials/title.tpl.php' ?>
    <div class="actions">
        <a href="<?= $router->generate('note-home') ?>">Retour</a>
        <a href="<?= $router->generate('note-update', ['id' => $note->getId()]) ?>">Modifier la note</a>
    </div>

    <section class="noteContainer">
        <div class="display-title">
            <h3><?= $note->getTitle() ?></h3>
        </div>
        <div class="display-content">
            <p><?= $note->getContent() ?></p>
        </div>
        <div class="display-dates">
            <p>Créé le : <span class="display-date"><?= date('d/m/Y', strtotime($note->getCreated_at())) ?></span>
            <?php if(!is_null($note->getUpdated_at())): ?> - Dernière modification le : <span class="display-date"><?= date('d/m/Y', strtotime($note->getUpdated_at())); endif ?></span></p>
        </div>
    </section>

</main>