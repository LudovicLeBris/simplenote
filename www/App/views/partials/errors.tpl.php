<?php if (isset($errorsList) && !empty($errorsList)) : ?>
    <div>
        <?php foreach ($errorsList as $error) : ?>
            <div><?= $error; ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>