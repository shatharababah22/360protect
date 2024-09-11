<?php

namespace backend\assets;

use yii\web\AssetBundle;

class SweetAlertAsset extends AssetBundle
{
    public $basePath = '@vendor/bower/sweetalert/dist';
    public $baseUrl = '@web/vendor/bower/sweetalert/dist';
    public $css = [
        'sweetalert.css', // Adjust the actual CSS filename if different
    ];
    public $js = [
        'sweetalert.min.js',
        // Add other JS files as needed
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
