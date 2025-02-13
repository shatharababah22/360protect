<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
// echo __DIR__;
// die();
require __DIR__ . '/../yii/vendor/autoload.php';
require __DIR__ . '/../yii/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../yii/common/config/bootstrap.php';
require __DIR__ . '/../yii/backend/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../yii/common/config/main.php',
    require __DIR__ . '/../yii/common/config/main-local.php',
    require __DIR__ . '/../yii/backend/config/main.php',
    require __DIR__ . '/../yii/backend/config/main-local.php'
);

(new yii\web\Application($config))->run();
