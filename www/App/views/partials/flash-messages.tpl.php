<?php if (isset($flashMessages) && !empty($flashMessages)) : ?>
    <div>

        <?php foreach ($flashMessages as $flashMessage) : ?>

            <div class="<?= $flashMessage['type'] ?>" role="alert">
                <?= $flashMessage['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php endforeach ?>
    </div>

<?php endif ?>