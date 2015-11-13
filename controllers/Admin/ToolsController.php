<?php

namespace app\controllers\Admin;

use app\models\DBManager;
use Yii;

use yii\web\Controller;

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
        $result = '';
        if (Yii::$app->request->isPost) {
            $db = new DBManager('localhost', 'root', '', 'coach_system', 'utf-8' );
            $result = $db->backup ('',Yii::$app->basePath . '/web/db_backup/', '200000');   //全部备份用这个
        }

        return $this->render('backup',['result' => $result]);
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