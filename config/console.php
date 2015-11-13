<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'web_auth_item',
            'assignmentTable' => 'web_auth_assignment',
            'itemChildTable' => 'web_auth_item_child',
            'ruleTable'=>'web_auth_rule'
        ],
    ],
    'params' => $params,
];
