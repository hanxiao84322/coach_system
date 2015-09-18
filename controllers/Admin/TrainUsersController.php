<?php

namespace app\controllers\Admin;

use app\models\Attendance;
use app\models\Level;
use app\models\Pages;
use app\models\Train;
use app\models\Users;
use app\models\UsersInfo;
use app\models\UsersLevel;
use Yii;
use app\models\TrainUsers;
use app\models\TrainUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;
use yii\web\User;


/**
 * TrainUsersController implements the CRUD actions for TrainUsers model.
 */
class TrainUsersController extends Controller
{

    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TrainUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrainUsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrainUsers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->trainName = Train::getOneTrainNameById($model->train_id);
        $model->userName = \app\models\Users::getOneUserNameById($model->user_id);
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new TrainUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrainUsers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrainUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $trainInfo = Train::findOne(['id',$model->train_id]);
        $model->userName = \app\models\Users::getOneUserNameById($model->user_id);
        $model->trainName = $trainInfo->name;
        if (Yii::$app->request->isPost) {

            $updateParams = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();
            if ($updateParams['TrainUsers']['practice_score'] > 100 || $updateParams['TrainUsers']['theory_score'] > 100 || $updateParams['TrainUsers']['rule_score'] > 100) {
                throw new ServerErrorHttpException('评分更新错误，原因：每项评分都不能超过100分！');
            }
            if ($model->load($updateParams) && $model->save()) {
                if ($updateParams['TrainUsers']['status'] == TrainUsers::END) {//如果结束状态，必须评分
                    if ($updateParams['TrainUsers']['practice_score'] <= 0 || $updateParams['TrainUsers']['theory_score'] <= 0 || $updateParams['TrainUsers']['rule_score'] <= 0) {
                        throw new ServerErrorHttpException('评分更新错误，原因：每项评分都必须大于零！');
                    }
                    //根据3个单项评分计算全部评价内容包括考勤
                    $result = $this->getSource($model->train_id, $model->user_id, $model->practice_score, $model->theory_score, $model->rule_score);
                    $model->score_appraise = $result['scoreAppraise'];
                    $model->appraise_result = $result['performance'];
                    $model->attendance_appraise = $result['attendanceComment'];
                    $model->practice_comment = $result['practiceComment'];
                    $model->theory_comment = $result['theoryComment'];
                    $model->rule_comment = $result['rulesComment'];
                    $model->total_comment = $result['commentAppraise'];
                    $model->result_comment = $result['scoreAppraise'];
                    $model->status = $result['status'];
                    if ($model->save()) {
                        //如果通过更新晋级信息
                        if ($model->status == TrainUsers::PASS) {
                            $trainCode = $trainInfo['code'];
                            $levelCode = Level::getOneCodeById($model->level_id);
                            $certificateNumber = $this->getCertificateNumber($trainCode, sprintf("%04d", $model->orders), $levelCode);
                            $res = UsersLevel::updateAll(['status'=>1, 'certificate_number' => $certificateNumber, 'update_time' => date('Y-m-d H:i:s', time()), 'update_user' => Yii::$app->admin->identity->username], ['user_id' => $model->user_id, 'train_id' => $model->train_id]);
                            if ($res) {
                                $transaction->commit();
                                return $this->redirect(['view', 'id' => $model->id]);
                            } else {
                                $transaction->rollBack();
                                throw new ServerErrorHttpException('更新晋升信息错误，原因：' . json_encode($res, JSON_UNESCAPED_UNICODE) . '！');
                            }
                        } else {
                            //如果没有通过，删除users_level表信息
                            $deleteUsersLevelResult = UsersLevel::deleteAll(['user_id' => $model->user_id, 'train_id' => $model->train_id]);
                            if (!$deleteUsersLevelResult) {
                                $transaction->rollBack();
                                throw new ServerErrorHttpException('评分更新错误，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE) . '！');
                            } else {
                                $transaction->commit();
                                Yii::$app->getSession()->setFlash('success', '更新成功！');
                                return $this->redirect(['view', 'id' => $model->id]);
                            }
                        }
                    } else {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('评分更新错误，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE) . '！');
                    }
                } else if($updateParams['TrainUsers']['status'] == TrainUsers::ENROLL) {
                    //如果录取，给出用户的序号
                    $trainUsersOrder = TrainUsers::getTrainUsersOrder($model->user_id, $model->train_id);
                    if (empty($trainUsersOrder)) {
                        $trainUsersOrder = 1;
                    }
                    $model->orders = $trainUsersOrder;
                    $model->status = TrainUsers::ENROLL;

                    if ($model->save()) {
                        //新增一条用户和级别对应的信息，只有在录取状态下才能确认添加，状态为未通过
                        $userLevelModel = new UsersLevel();
                        $userLevelModel->user_id = $model->user_id;
                        $userLevelModel->train_id = $model->train_id;
                        $userLevelModel->level_id = $model->level_id;
                        $userLevelModel->district = $trainInfo['district'];
                        $userLevelModel->credentials_number = UsersInfo::getCredentialsNumberByUserId($model->user_id);
                        if (!$userLevelModel->save()) {
                            $transaction->rollBack();
                            throw new ServerErrorHttpException('更新状态错误，原因：' . json_encode($userLevelModel->errors, JSON_UNESCAPED_UNICODE) . '！');
                        } else {
                            $transaction->commit();
                            Yii::$app->getSession()->setFlash('success', '更新成功！');
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    } else {
                        $transaction->rollBack();
//                    Yii::$app->getSession()->setFlash('error', '更新状态错误，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE) . '！');
                        throw new ServerErrorHttpException('更新状态错误，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE) . '！');
                    }
                } else {
                    $transaction->commit();
                    Yii::$app->getSession()->setFlash('success', '更新成功！');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $transaction->rollBack();
                throw new ServerErrorHttpException('评分更新错误，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE) . '！');
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TrainUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrainUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrainUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrainUsers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Lists all TrainUsers models.
     * @return mixed
     */
    public function actionAttendance()
    {
        $searchModel = new TrainUsersSearch();
        $queryParams = [
            'TrainUsersSearch' => Yii::$app->request->queryParams
        ];
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('attendance', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 计算评分。
     *
     * 评分：实践（满分100分）理论（满分100分）规则（满分100分） 总评（（实践分数+理论分数+规则分数）/3）
     *
     * 考勤：迟到20，早退20，旷课40，请假10
     *
     * 评估：优，90以上，良，60-89，差0-59
     *
     * 评价结果：
     *
     * 1：推荐晋级（80以上）  这种不需要获得活动中的晋级积分 优
     *  2：实践1年推荐晋级（60-79）需要获得80分晋级积分，满12个月晋级 良
     *  3：仅限当前级（60-79）无法晋级
     *  4：通过（60以上）满80分可晋级
     *  5：未通过（0-59）差
     *
     * @param $practice_score
     * @param $theory_score
     * @param $rule_score
     * @param $train_id
     * @param $user_id
     *
     */
    public function getSource($trainId, $userId, $practiceScore, $theoryScore, $ruleScore)
    {
        if (!empty($practiceScore) && !empty($theoryScore) && !empty($ruleScore)) {
            //成绩总评
            $scoreAppraise = intval(($practiceScore + $theoryScore + $ruleScore) / 3);
            //考勤
            $attendanceList = Attendance::getAllByTrainIdAndUserId($trainId, $userId);
            $attendanceScore = 100;
            foreach ($attendanceList as $key => $val) {

                if ($val['status'] == Attendance::LATER) {
                    $attendanceScore -= Attendance::LATER_SOURCE;
                } elseif ($val['status'] == Attendance::EARLY) {
                    $attendanceScore -= Attendance::EARLY_SOURCE;
                } elseif ($val['status'] == Attendance::ABSENCES) {
                    $attendanceScore -= Attendance::ABSENCES_SOURCE;
                } elseif ($val['status'] == Attendance::LEAVE) {
                    $attendanceScore -= Attendance::LEAVE_SOURCE;
                } else {
                    $attendanceScore == $attendanceScore;
                }
            }
            if ($attendanceScore < 0) {
                $attendanceScore = 1;
            }
            //获取评估
            foreach (TrainUsers::$assessRules as $k => $v) {
                if ($attendanceScore > $v['small'] && $attendanceScore <= $v['big']) {
                    //考勤结果
                    $attendanceComment = TrainUsers::$assessList[$k];
                }
                if ($scoreAppraise > $v['small'] && $scoreAppraise <= $v['big']) {
                    //评估总评
                    $commentAppraise = TrainUsers::$assessList[$k];
                    //成绩评价结果
                    $performance = TrainUsers::$performanceList[$k];
                }
                if ($practiceScore > $v['small'] && $practiceScore <= $v['big']) {
                    //实践评估
                    $practiceComment = TrainUsers::$assessList[$k];
                }
                if ($theoryScore > $v['small'] && $theoryScore <= $v['big']) {
                    //理论评估
                    $theoryComment = TrainUsers::$assessList[$k];
                }
                if ($ruleScore > $v['small'] && $ruleScore <= $v['big']) {
                    //规则评估
                    $rulesComment = TrainUsers::$assessList[$k];
                }
            }
            foreach (TrainUsers::$statusRules as $kk => $vv) {
                if ($scoreAppraise > $vv['small'] && $scoreAppraise <= $vv['big']) {
                    $status = $kk;
                }
            }
            $result = [
                'scoreAppraise' => $scoreAppraise,
                'performance' => $performance,
                'attendanceComment' => $attendanceComment,
                'practiceComment' => $practiceComment,
                'theoryComment' => $theoryComment,
                'rulesComment' => $rulesComment,
                'commentAppraise' => $commentAppraise,
                'status' => $status
            ];
        }

        return $result;
    }

    public function getCertificateNumber($trainCode, $userOrder, $levelCode)
    {
        $certificateNumber = 'BJ' . $levelCode . $trainCode . $userOrder;
        return $certificateNumber;
    }

}
