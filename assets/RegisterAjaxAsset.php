<?php

namespace app\assets;

use yii\web\AssetBundle;

class RegisterAjaxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        "https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js",
        'js/registerAjax.js',
    ];

    public $depends = [
        NiceAdminAsset::class
    ];
}
