<?php if (isset($flashMessages) && !empty($flashMessages)) : ?>
    <div>

        <?php foreach ($flashMessages as $flashMessage) : ?>

            <div class="<?= $flashMessage['type'] ?>">
                <?= $flashMessage['message'] ?>
                <button type="button">X</button>
            </div>

        <?php endforeach ?>
    </div>

<?php endif ?>