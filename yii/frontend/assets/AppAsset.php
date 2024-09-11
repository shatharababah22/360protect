<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'libs/swiper/swiper-bundle.min.css',
        'libs/glightbox/dist/css/glightbox.min.css',
        // 'libs/simplebar/dist/simplebar.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        'libs/scrollcue/scrollCue.css',
        'fonts/css/boxicons.min.css',
        'css/theme.min.css',
        'css/main.css',
        // 'css/datepicker-kv',
        'css/style.css',
        'css/flatpickr.css',
        'https://cdnjs.cloudflare.com/ajax/libs/owl.carousel/2.3.4/assets/owl.carousel.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/owl.carousel/2.3.4/assets/owl.theme.default.min.css',
    ];
    public $js = [
        'libs/bootstrap/dist/js/bootstrap.bundle.min.js',
        // 'libs/simplebar/dist/simplebar.min.js',
        'libs/headhesive/dist/headhesive.min.js',
        'js/theme.min.js',
      'libs/jarallax/dist/jarallax.min.js',
      'js/vendors/jarallax.js',
      'libs/parallax-js/dist/parallax.min.js',
      'js/vendors/parallax.js',
      'libs/swiper/swiper-bundle.min.js',
      'js/vendors/swiper.js',
      'libs/glightbox/dist/js/glightbox.min.js',
      'js/vendors/glight.js',
      'libs/scrollcue/scrollCue.min.js',
      'js/vendors/scrollcue.js',
    //   'js/bootstrap-datepicker',
   
      'js/flatpickr.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/owl.carousel/2.3.4/owl.carousel.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
