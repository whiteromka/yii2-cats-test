<?php

/** @var yii\web\View $this */
/** @var array $result */

//debug($result);
?>

<div class="row">
    <div class="col-md-6">
        <h1>Отлично вы создали <?= $result['countSuccess'] ?> котов!</h1>
        <ul>
            <?php
            $names = $result['successCatNames'];
            foreach ($names as $catName) {
                echo '<li>' . $catName . '</li>';
            } ?>
        <ul>
    </div>

    <div class="col-md-6">
        <?php if ($result['countErrors'] > 0) { ?>
            <h2>К сожалению не создалось <?= $result['countErrors'] ?> котов!</h2>
        <?php } ?>

        <ul>
            <?php
            $badCats = $result['errorsCatNames'];
            foreach ($badCats as $catName => $errorList) {
                foreach ($errorList as $error) {
                    echo "<li> $catName - $error </li>";
                }
            } ?>
            <ul>
    </div>
</div>

