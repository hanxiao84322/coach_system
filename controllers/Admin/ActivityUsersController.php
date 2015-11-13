<?php

namespace app\controllers\Admin;

use app\models\Activity;
use app\models\ActivityProcess;
use app\models\Messages;
use app\models\MessagesUsers;
use Yii;
use app\models\ActivityUsers;
use app\models\Users;
use app\models\ActivityUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;

/**
 * ActivityUsersController implements the CRUD actions for ActivityUsers model.
 */
class ActivityUsersController extends Controller
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
     * Lists all ActivityUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivityUsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $statusList = [
            ActivityUsers::APPROVED => '审核中',
            ActivityUsers::ENROLL => '已录取',
            ActivityUsers::DOING => '进行中',
            ActivityUsers::NO_APPROVED => '审核未通过',
        ];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statusList' => $statusList
        ]);
    }

    /**
     * Displays a single ActivityUsers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->activityName = Activity::getOneActivityNameById($model->activity_id);
        $model->userName = Users::getOneUserNameById($model->user_id);
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new ActivityUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActivityUsers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ActivityUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $activityInfo = Activity::findOne(['id',$model->activity_id]);
        $userInfo = Users::findOne($model->user_id);
        $model->userName = $userInfo['username'];
        $model->activityName = $activityInfo->name;
        if (Yii::$app->request->isPost) {

            $updateParams = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();
            if ($updateParams['ActivityUsers']['practice_score'] > 100 || $updateParams['ActivityUsers']['theory_score'] > 100 || $updateParams['ActivityUsers']['rule_score'] > 100) {
                throw new ServerErrorHttpException('评分更新错误，原因：每项评分都不能超过100分！');
            }
            if ($model->load($updateParams) && $model->save()) {
                if ($updateParams['ActivityUsers']['status'] == ActivityUsers::END) {//如果结束状态，必须评分
                    if ($updateParams['ActivityUsers']['practice_score'] <= 0 || $updateParams['ActivityUsers']['theory_score'] <= 0 || $updateParams['ActivityUsers']['rule_score'] <= 0) {
                        throw new ServerErrorHttpException('评分更新错误，原因：每项评分都必须大于零！');
                    }
                    //根据3个单项评分计算全部评价内容包括考勤
                    $result = $this->getSource($model->activity_id, $model->user_id, $model->practice_score, $model->theory_score, $model->rule_score);
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
                        if ($model->status == ActivityUsers::PASS) {
//                            $messagesInfo = Messages::findOne(['id' => 29]);
//                            $message = $messagesInfo['content'];
//                            $data = [
//                                'messages_id' => 29,
//                                'users_id' => $model->user_id,
//                            ];
//                            MessagesUsers::addInfo($data);
                            $content = "尊敬的学员，您已经被成功完成活动，请到个人中心查看具体信息，谢谢。【教练系统】";
//                            $smsModel = Sms::getInstance(Yii::$app->params['smsUserName'],Yii::$app->params['smsPassword']);
//                            $result = $smsModel->pushMt($userInfo['phone'], time(), $content, 0);
//                            if ($result != '0') {
//                                throw new ServerErrorHttpException('更新状态错误，原因：' . $result . '！');
//                            }
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);

                        }
                        $transaction->commit();
                        Yii::$app->getSession()->setFlash('success', '更新成功！');
                    } else {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('评分更新错误，原因：' . json_encode($model->errors, JSON_UNESCAPED_UNICODE) . '！');
                    }
                } else if($updateParams['ActivityUsers']['status'] == ActivityUsers::ENROLL) {
                    //如果录取，给出用户的序号
                    $activityUsersOrder = ActivityUsers::getActivityUsersOrder($model->user_id, $model->activity_id);
                    if (empty($activityUsersOrder)) {
                        $activityUsersOrder = 1;
                    }
                    $model->orders = $activityUsersOrder;
                    $model->status = ActivityUsers::ENROLL;

                    if ($model->save()) {
                        $transaction->commit();
//                        $messagesInfo = Messages::findOne(['id' => 30]);
//                        $message = $messagesInfo['content'];
//                        $data = [
//                            'messages_id' => 30,
//                            'users_id' => $model->user_id,
//                        ];
//                        MessagesUsers::addInfo($data);
//                        $content = $message . "【教练系统】";
                        //录取发短信
//                        $content = "尊敬的学员，您已经被成功录取，序号为" . $activityUsersOrder . ",谢谢！【教练系统】";
//                        $smsModel = Sms::getInstance(Yii::$app->params['smsUserName'],Yii::$app->params['smsPassword']);
//                        $result = $smsModel->pushMt($userInfo['phone'], time(), $content, 0);
//                        if ($result != '0') {
//                            throw new ServerErrorHttpException('更新状态错误，原因：' . $result . '！');
//                        }
                        return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing ActivityUsers model.
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
     * Finds the ActivityUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActivityUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivityUsers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
    public function getSource($activityId, $userId, $practiceScore, $theoryScore, $ruleScore)
    {
        if (!empty($practiceScore) && !empty($theoryScore) && !empty($ruleScore)) {
            //成绩总评
            $scoreAppraise = intval(($practiceScore + $theoryScore + $ruleScore) / 3);
            //考勤
            $attendanceList = ActivityProcess::getAllByActivityIdAndUserId($activityId, $userId);
            $attendanceScore = 100;
            foreach ($attendanceList as $key => $val) {

                if ($val['status'] == ActivityProcess::NO_FINISH) {
                    $attendanceScore -= ActivityProcess::NO_FINISH_SOURCE;
                } else {
                    $attendanceScore == $attendanceScore;
                }
            }
            if ($attendanceScore < 0) {
                $attendanceScore = 1;
            }
            //获取评估
            foreach (ActivityUsers::$assessRules as $k => $v) {
                if ($attendanceScore > $v['small'] && $attendanceScore <= $v['big']) {
                    //考勤结果
                    $attendanceComment = ActivityUsers::$assessList[$k];
                }
                if ($scoreAppraise > $v['small'] && $scoreAppraise <= $v['big']) {
                    //评估总评
                    $commentAppraise = ActivityUsers::$assessList[$k];
                    //成绩评价结果
                    $performance = ActivityUsers::$performanceList[$k];
                }
                if ($practiceScore > $v['small'] && $practiceScore <= $v['big']) {
                    //实践评估
                    $practiceComment = ActivityUsers::$assessList[$k];
                }
                if ($theoryScore > $v['small'] && $theoryScore <= $v['big']) {
                    //理论评估
                    $theoryComment = ActivityUsers::$assessList[$k];
                }
                if ($ruleScore > $v['small'] && $ruleScore <= $v['big']) {
                    //规则评估
                    $rulesComment = ActivityUsers::$assessList[$k];
                }
            }
            foreach (ActivityUsers::$statusRules as $kk => $vv) {
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
        $date = date('Ymd', time());
        $certificateNumber = 'BJ' . $levelCode . $trainCode . $date . $userOrder;
        return $certificateNumber;
    }


    /**
     * Lists all TrainUsers models.
     * @return mixed
     */
    public function actionActivityProcess()
    {
        $searchModel = new ActivityUsersSearch();
        $queryParams = [
            'ActivityUsersSearch' => Yii::$app->request->queryParams
        ];
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('activity-process', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdateStatus() {
        $status = Yii::$app->request->post('status');
        $idList = Yii::$app->request->post('selection');
        if (!empty($status) && !empty($idList)) {
            foreach ($idList as $key => $val) {
                ActivityUsers::updateAll(['status' => $status], ['id' => $val]);
                if ($status == ActivityUsers::ENROLL) {
                    $activityUsersInfo = ActivityUsers::findOne($val);
                    //录取发送系统通知
                    $content = "尊敬的学员，您已经被成功录取，序号为" . $activityUsersInfo['orders'] . "，请缴费，谢谢！【教练系统】";
                    $userInfo = Users::findOne(['id' => $activityUsersInfo['user_id']]);
                    $result = $this->sendMessage($content,Messages::ACTIVITY_SIGN_SUCCESS,$activityUsersInfo['user_id'],$userInfo['mobile_phone']);
                    if ($result != '0') {
                        throw new ServerErrorHttpException('更新状态错误，原因：' . $result . '！');
                    }
                }

            }
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            throw new ServerErrorHttpException('更新状态错误，原因：请选择评分信息！');
        }
    }

    public function sendMessage($content,$type,$userId,$phone)
    {
        $messagesUsersInfo['messages_id'] = 1;
        $messagesUsersInfo['type'] = $type;
        $messagesUsersInfo['title'] = Messages::$typeList[$type];
        $messagesUsersInfo['users_id'] = $userId;
        $messagesUsersInfo['content'] = $content;
        $messagesUsersInfo['create_time'] = date('Y-m-d H:i:s', time());
        $messagesUsersInfo['create_user'] = 'admin';
        $messagesUsersInfo['update_time'] = date('Y-m-d H:i:s', time());
        $messagesUsersInfo['update_user'] = 'admin';
        MessagesUsers::addInfo($messagesUsersInfo);
        $smsModel = Sms::getInstance(Yii::$app->params['smsUserName'],Yii::$app->params['smsPassword']);
        $result = $smsModel->pushMt($phone, time(), $content, 0);

        return $result;
    }

}
