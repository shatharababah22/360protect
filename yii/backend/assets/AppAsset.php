<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/theme.min.css',
        'vendor/bootstrap-icons/font/bootstrap-icons.css',
        'vendor/daterangepicker/daterangepicker.css',
        
        'vendor/tom-select/dist/css/tom-select.bootstrap5.css',
        'vendor/quill/dist/quill.snow.css',
        'css/site.css',
        //    'css/theme-dark.min.css'
    ];
    public $js = [
        'js/hs.theme-appearance.js',
        'js/filereader.js',
        'vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js',
        'vendor/jquery/dist/jquery.min.js',

        'vendor/jquery-migrate/dist/jquery-migrate.min.js',
        'vendor/bootstrap/dist/js/bootstrap.bundle.min.js',
        'vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js',
        'vendor/hs-form-search/dist/hs-form-search.min.js',
        'js/theme.min.js',
 
        'vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js',
        
        'vendor/datatables.net.extensions/select/select.min.js',
        'vendor/hs-nav-scroller/dist/hs-nav-scroller.min.js',
        'vendor/tom-select/dist/js/tom-select.complete.min.js',
        'vendor/datatables/media/js/jquery.dataTables.min.js',
        'vendor/hs-add-field/dist/hs-add-field.min.js'
        ,'vendor/hs-quantity-counter/dist/hs-quantity-counter.min.js',
        'vendor/daterangepicker/moment.min.js',
        'vendor/daterangepicker/daterangepicker.js'



    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        'backend\assets\SweetAlertAsset',
    ];
}
