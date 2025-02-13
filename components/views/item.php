<?php

/** @var yii\web\View $this */
/** @var string $imgSrc */
/** @var string $name */
/** @var string $description */
/** @var string $buttonName */
/** @var string $buttonLink */
/** @var int $catId */
?>

<div class="card">
    <?php if ($imgSrc) { ?>
        <img src="<?= $imgSrc ?>" class="card-img-top" alt="<?= $name?>" title="<?= $name?>">
    <? } ?>

    <div class="card-body">
        <h5 class="card-title"><?= $name?> </h5>
        <p class="card-text"> <?= $description ?></p>
        <?php if ($buttonName && $buttonLink) { ?>
            <a href="<?= $buttonLink ?>" data-cat-id="<?= $catId?>" class="btn btn-success js-btn-cartAjax"> <?= $buttonName ?> </a>
        <?php } ?>
    </div>
</div>
<br>
