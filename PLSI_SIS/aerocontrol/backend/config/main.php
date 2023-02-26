<?php

use yii\web\Response;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log-reader'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ],
        'log-reader' => [
            'class' => 'kriss\logReader\Module',
            'aliases' => [
                //'Frontend' => '@frontend/runtime/logs/app.log',
                'Backend' => '@backend/runtime/logs/aerocontrol.log',
                //'Console' => '@console/runtime/logs/app.log',
            ],
        ]
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'lacpIbbXbVwTw-hPp6sfTC1DPr1u1uPz',
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['admin', 'airplane', 'airport', 'client', 'company', 'employee', 'employeeFunction', 'flight', 'lostItem', 'manager', 'paymentMethod', 'restaurant', 'restaurantItem', 'store'],
                    'exportInterval' => 1,
                    'logFile' => '@backend/runtime/logs/aerocontrol.log',
                    'logVars' => ["_POST", "_GET", "_FILES", "_SESSION"],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => 'api/user',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST resetPassword' => 'reset-password'  // Faz a actionResetPassword
                    ],
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/restaurant'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/store'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/user'],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => 'api/auth',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST login' => 'login',  // Faz a actionLogin
                        'POST signup' => 'signup'   // Faz a actionSignup
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => 'api/flight-ticket',
                    'extraPatterns' => [
                        'GET my-tickets' => 'my-tickets'  // Faz a actionMytickets
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => 'api/support-ticket',
                    'extraPatterns' => [
                        'GET my-support-tickets' => 'my-support-tickets'  // Faz a actionMytickets
                    ],
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/ticket-message',],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/airport'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/payment-method'],
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => 'api/flight',
                    'extraPatterns' => [
                        'GET search' => 'search' // Faz a actionSearch
                    ]
                ],
            ],
        ],

        'response' => [
            'formatters' => [
                Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
                ]
            ]
        ],

    ],
    'params' => $params,
];
