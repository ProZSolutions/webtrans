<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '5oZgLNCHGH4zEFKpjJdfP0bF_mU2tJ-n',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            'transport/update-transport/<id:\w+>'=>'transport/update-transport',
            'transport/delete-transport/<id:\w+>'=>'transport/delete-transport',
            'transport/view-transport/<id:\w+>'=>'transport/view-transport',

            'vendor/update-vendor/<id:\w+>'=>'vendor/update-vendor',
            'vendor/delete-vendor/<id:\w+>'=>'vendor/delete-vendor',
            'vendor/get-vendor/<id:\w+>'=>'vendor/get-vendor',

            'driver/update-driver/<id:\w+>'=>'driver/update-driver',
            'driver/delete-driver/<id:\w+>'=>'driver/delete-driver',
            'driver/view-driver/<id:\w+>'=>'driver/view-driver',
            'driver/default-driver/<id:\w+>'=>'driver/default-driver',

            'dbank/update-bank/<id:\w+>'=>'dbank/update-bank',
            'dbank/delete-bank/<id:\w+>'=>'dbank/delete-bank',
            'dbank/view-bank/<id:\w+>'=>'dbank/view-bank',
            'dbank/get-bank/<id:\w+>'=>'dbank/get-bank',

            'transport-bank/update-bank/<id:\w+>' => 'transport-bank/update-bank',
            'transport-bank/delete-bank/<id:\w+>' => 'transport-bank/delete-bank',
            'transport-bank/view-bank/<id:\w+>' => 'transport-bank/view-bank',

            'card/update-card/<id:\w+>' => 'card/update-card',
            'card/delete-card/<id:\w+>' => 'card/delete-card',
            'card/view-card/<id:\w+>' => 'card/view-card',


            'driver-pay/update-payment/<id:\w+>' => 'driver-pay/update-payment',
            'driver-pay/view-payment/<id:\w+>' => 'driver-pay/view-payment',
            'driver-pay/get-payment/<id:\w+>' => 'driver-pay/get-payment',
            'driver-pay/delete-payment/<id:\w+>' => 'driver-pay/delete-payment',
            
            'vehicle/update-vehicle/<id:\w+>' => 'vehicle/update-vehicle',
            'vehicle/delete-vehicle/<id:\w+>' => 'vehicle/delete-vehicle',
            'vehicle/view-vehicle/<id:\w+>' => 'vehicle/view-vehicle',

            'bill/update-bill/<id:\w+>' => 'bill/update-bill',
            'bill/delete-bill/<id:\w+>' => 'bill/delete-bill',
            'bill/view-bill/<id:\w+>' => 'bill/view-bill',


            'card-deposit/update-deposit/<id:\w+>' => 'card-deposit/update-deposit',
            'card-deposit/delete-deposit/<id:\w+>' => 'card-deposit/delete-deposit',
            'card-deposit/view-deposit/<id:\w+>' => 'card-deposit/view-deposit',

            'trip/ltrip/update-ltrip/<id:\w+>' => 'trip/ltrip/update-ltrip',
            'trip/ltrip/delete-ltrip/<id:\w+>' => 'trip/ltrip/delete-ltrip',
            'trip/ltrip/view-ltrip/<id:\w+>' => 'trip/ltrip/view-ltrip',
            'trip/ltrip/close-ltrip/<id:\w+>' => 'trip/ltrip/close-ltrip',
            'trip/ltrip/unload-ltrip/<id:\w+>' => 'trip/ltrip/unload-ltrip',

            'trip/lexpense/update-expense/<id:\w+>' => 'trip/lexpense/update-expense',
            'trip/lexpense/delete-expense/<id:\w+>' => 'trip/lexpense/delete-expense',
            'trip/lexpense/view-expense/<id:\w+>' => 'trip/lexpense/view-expense',
            'trip/lexpense/get-expense/<id:\w+>' => 'trip/lexpense/get-expense',


            'trip/ldiesel/update-diesel/<id:\w+>' => 'trip/ldiesel/update-diesel',
            'trip/ldiesel/delete-diesel/<id:\w+>' => 'trip/ldiesel/delete-diesel',
            'trip/ldiesel/view-diesel/<id:\w+>' => 'trip/ldiesel/view-diesel',
            'trip/ldiesel/get-diesel/<id:\w+>' => 'trip/ldiesel/get-diesel',

           

            ],
        ],
        
    ],
    'modules' => [
        'trip' => [
            'class' => 'app\modules\trip\Module',
        ],
        'tyre' => [
            'class' => 'app\modules\tyre\Module',
        ],
        'payment' => [
            'class' => 'app\modules\payment\Module',
        ],
        'reportico' => [
            'class' => 'reportico\reportico\Module' ,
            'controllerMap' => [
                            'reportico' => 'reportico\reportico\controllers\ReporticoController',
                            'mode' => 'reportico\reportico\controllers\ModeController',
                            'ajax' => 'reportico\reportico\controllers\AjaxController',
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
