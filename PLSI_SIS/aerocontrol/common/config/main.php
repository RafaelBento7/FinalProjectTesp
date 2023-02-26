<?php
return [
    'name' => 'Aerocontrol',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => 'localhost/projetofinal/aerocontrol/frontend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=aerocontrol',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'encryption' => 'tls',
                'dsn' => 'smtp://aerocontrol.acc@gmail.com:nqctnysxdzqhzbyz@smtp.gmail.com:25',

            ],
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],

        'formatter' => [
            'datetimeFormat' => 'php:d-m-Y H:i',
            'dateFormat' => 'php:d-m-Y',
            'timeFormat' => 'php:H:i',
            'nullDisplay' => 'N/A'
        ]
    ],
    'timeZone' => 'Europe/Lisbon',
];
