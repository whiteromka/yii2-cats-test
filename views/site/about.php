<?php

/** @var yii\web\View $this */
/** @var array $user */
/** @var string $passport */
/** @var array $userList */
// $userList = ['Rom', 'Anna', 'Bob'];
use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>

    <h1>User Data</h1>
    <p>user name:  <?= $user['name']?> </p>
    <p>user age:  <?= $user['age']?> </p>


    <h1>UserList</h1>
    <ul>
    <?php foreach ($userList as $user) {
        echo "<li>" . $user . "</li>";
    } ?>
    </ul>


</div>
