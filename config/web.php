<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'defaultRoute' => 'category/index', // стартовый роут
    'modules' => [  // наш модуль
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin', // указываем шаблон для модуля
            'defaultRoute' => 'order/index', // стартовый роут для админ
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    // расширение  mihaildev/elfinder
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'baseUrl' => '/web',
//                'basePath' => '@webroot',
                'path' => 'upload/global',
                'name' => 'Global'
            ],
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'vBrdgOvqtCGqtiRahRooKDjX0zlOZpTh',
            'baseUrl'=> '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => 'login', // куда будет перенаправлен пользователь если он не авторизован
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
//            'useFileTransport' => true,
            'useFileTransport' => false,

            'transport' => [
                'class' => 'Swift_SmtpTransport',
//                'host' => 'localhost',
                'host' => 'smtp.gmail.com', //ssl://smtp.yandex.com
//                'username' => 'username',
                'username' => 'afonin006@gmail.com',
                'password' => 'Va989126',
                'port' =>  '587',
                'encryption' => 'tls'
//                'port' =>  '465',
//                'encryption' => 'ssl'

            ],


        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'category/<id:\d+>/page/<page:\d+>' => 'category/view',
                'category/<id:\d+>' => 'category/view',
                'product/<id:\d+>' => 'product/view',
                "<action:(about|login|contact)>" => 'site/<action>',
                'search' => 'category/search',
                '<controller>/<action>' => '<controller>/<action>',
//                'about' => 'site/about',
//                'login' => 'site/login',
//                'contact' => 'site/contact'


            ]

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
