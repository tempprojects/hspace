<?php
use developeruz\db_rbac\behaviors\AccessBehavior;
use yii\filters\AccessControl;
use backend\models\Action;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$access_roles=require(__DIR__ . '/access-roles.php');

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'permit' => [
            'class' => 'developeruz\db_rbac\Yii2DbRbac',
        ],
        'configs'=>[
            'class' => 'myextension\configs\Configs',
        ],
    ],
    // 'as AccessBehavior' => [
    //     'class' => AccessBehavior::className(),
    //     'rules' =>
    //         ['permit/access' =>
    //             [
    //                 [
    //                     'allow' => true,
    //                 ],
    //             ]
    //         ]
    // ],

    'components' => [
        'congfigs' => [
            'class' => 'myextension\configs\components\Geter',
            'cache'=>   120
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login'], 
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => 'http://localhost/yii2_hspace/frontend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManagerBase' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => 'http://localhost/yii2_hspace',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    // THIS IS IMPORTANT!!! AccessControl in the backend!!!
   'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'actions' => ['error', 'login'],
                'allow' => true,
                'roles' => ['?', '@']
            ],
            [
                'allow' => true,
                'roles' => $access_roles,
            ],
        ],
    ],
    'params' => $params,
];
