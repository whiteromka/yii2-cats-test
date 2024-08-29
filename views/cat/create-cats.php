<?php

/** @var yii\web\View $this */
/** @var array $result */
?>

<h1>Отлично вы создали <?= $result['success'] ?> котов!</h1>
<?php if ($result['errors'] > 0) { ?>
    <h2>К сожалению не создалось <?= $result['errors'] ?> котов!</h2>
<?php } ?>
