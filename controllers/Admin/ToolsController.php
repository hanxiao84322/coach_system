<?php

namespace app\controllers\Admin;

use Yii;
use app\models\Activity;
use app\models\ActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ToolsController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'user' => 'admin',
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    /**
     * Lists all Activity models.
     * @return mixed
     */
    public function actionClear()
    {
        return $this->render('clear');
    }

    public function actionBackup()
    {
        return $this->render('backup');
    }

    public function actionAttachments()
    {
        return $this->render('attachments');
    }

    public function actionRunLog()
    {
        return $this->render('run-log');
    }

}