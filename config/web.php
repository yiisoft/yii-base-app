<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'my-project',
    'basePath' => dirname(__DIR__) . '/src',
    'bootstrap' => [],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'logger' => require 'logger.php',
    'components' => [
        'cache' => require 'cache.php',
        'mailer' => require 'mailer.php',
        'mutex' => [
            '__class' => yii\mutex\FileMutex::class
        ],
        'db' => $db,
        'i18n' => [
            'translations' => [
                '*' => [
                    '__class' => yii\i18n\PhpMessageSource::class,
                ],
            ],
        ],

        'request' => [
            'enableCookieValidation' => false,
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'session' => [
            '__class' => yii\web\Session::class
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            '__class' => \yii\web\UrlManager::class,
            'rules' => require 'urls.php',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
