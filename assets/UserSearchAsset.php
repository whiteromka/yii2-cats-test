<?php

namespace app\assets;

use yii\web\AssetBundle;

class UserSearchAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
    ];

    public $js = [
        'js/userSearch.js'
    ];

    public $depends = [
        AppAsset::class
    ];
}
