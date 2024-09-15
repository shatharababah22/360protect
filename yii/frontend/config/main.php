<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'queue'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'languageComponent' => [
            'class' => 'common\components\LanguageComponent',
        ],
    
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false, 
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'shatha.rababah@releans.com',
                'password' => 'pypgbaxtfgguzyze',

                'port' => '587',
                'encryption' => 'tls',
            ],


        ],
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKey' => '6LfQb0QqAAAAAMJY2zbsTnjoxEzTmlkG7CW7WbE6',
            'secretV3' => '6LfutA8qAAAAAE-Vh475F2Jf60KM8Wgrkqtmu-z9',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],

        'queue' => [
            'class' => 'yii\queue\db\Queue',
            'db' => 'db',
            'tableName' => '{{%queue}}',
            'channel' => 'default',
            'mutex' => 'yii\mutex\MysqlMutex',
        ],
        'session' => [
            'name' => 'advanced-frontend',
        ],

        'i18n' => [
        'translations' => [
            'app*' => [
                'class' => 'yii\i18n\PhpMessageSource',
               'basePath' => '@frontend/messages',
                'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'app' => 'app.php',
                    'app/error' => 'error.php',
                ],
            ],
        ],
    ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        // 'cache' => [
        //     'class' => 'yii\caching\Cache',
        // ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'insurances' => 'insurance/type',
                'insurance/<slug>' => 'insurance/programs',
                'insurance/countries/<slug>' => 'site/index',
    

            ],
        ],

    ],
    'params' => $params,
];
