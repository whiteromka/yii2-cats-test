<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class NiceAdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        "https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i",
        "/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css",
        "/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css",
        "/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css",
        "/NiceAdmin/assets/vendor/quill/quill.snow.css",
        "/NiceAdmin/assets/vendor/quill/quill.bubble.css",
        "/NiceAdmin/assets/vendor/remixicon/remixicon.css",
        "/NiceAdmin/assets/vendor/simple-datatables/style.css",
        "/NiceAdmin/assets/css/style.css"
    ];

    public $js = [
        //'js/cartAjax.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
