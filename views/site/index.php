<?php

/** @var yii\web\View $this */
/** @var Cat|null $cat */
/** @var Cat[] $cats */
/** @var string $catsSqlQuery */

use app\models\Account;
use app\models\Car;
use app\models\Cat;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>


<div class="site-index">

    <h2>Cat:</h2>
    <?php if ($cat) {
        $dataCat = $cat->getBaseProperties();
        echo "<p> $dataCat <p>";
    } ?>

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>
        <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Heading !!!!!</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <a target="_blank"
                   href="<?= Url::to('super-rom')?>"
                >
                    Users
                </a>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>

            <div class="col-lg-4 mb-3">
               <h3><?= $catsSqlQuery?></h3>
                <?php
                   foreach ($cats as $cat) { ?>
                       <div class="card">
                            <?php
                                $firstImg = $cat->catPics[0] ?? null;
                                if ($firstImg) {
                                    $firstImg = $firstImg->pic_name;
                                }
                            ?>
                           <?php if ($firstImg) { ?>
                              <img src="<?= $firstImg ?>" class="card-img-top" alt="<?= $cat->name?>" title="<?= $cat->name?>">
                           <? } ?>

                           <div class="card-body">
                               <h5 class="card-title"><?= $cat->name?> <?= $cat->price?> $</h5>
                               <p class="card-text"> <?= $cat->getInfo() ?></p>
                           </div>
                       </div>
                       <br>
                 <?php  } ?>
            </div>

            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
