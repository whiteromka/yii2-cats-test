<?php

/** @var yii\web\View $this */
/** @var array $result */

use app\models\Cat;

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

        <?php
//        $badCats = $result['errorsCatNames'];
//        foreach ($badCats as $id => $errorList) {
//            $content = $id;
//            foreach ($errorList as $error) {
//                $content .= ' ' . $error[0] . ';';
//            }
//            echo "<p> $content </p>";
//        } ?>

        <?php
            $number = 1;
            $badCats = $result['badCats'];
            /** @var Cat $cat */
            foreach ($badCats as $cat) {
                $content = "<b>" . $cat->name . " : </b>";
                $prettyErrors = $cat->getPrettyErrors();
                foreach ($prettyErrors as $error) {
                    $content .= $error . '!!!!! ';
                }
                echo "<p> <i>$number)</i> $content </p>";
                $number++;
            }
        ?>

    </div>
</div>

