<?php

namespace app\controllers\Admin;

use app\models\Attendance;
use app\models\Level;
use app\models\Messages;
use app\models\MessagesUsers;
use app\models\Sms;
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
        $statusList = [
            TrainUsers::APPROVED => '审核中',
            TrainUsers::ENROLL => '已录取',
            TrainUsers::DOING => '进行中',
            TrainUsers::NO_APPROVED => '审核未通过',
            TrainUsers::END => '结束',
        ];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statusList' => $statusList
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
        $model->userName = Users::getOneUserNameById($model->user_id);
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
        $sourceStatus = $model->status;
        $userInfo = Users::findOne($model->user_id);
        $model->userName = $userInfo['username'];
        $model->trainName = $trainInfo->name;

        $statusList[TrainUsers::SIGN] = [
            'list' => [
                TrainUsers::APPROVED => TrainUsers::$statusList[TrainUsers::APPROVED]
            ]
        ];
        $statusList[TrainUsers::APPROVED] = [
            'list' => [
                TrainUsers::ENROLL => TrainUsers::$statusList[TrainUsers::ENROLL],
                TrainUsers::NO_APPROVED => TrainUsers::$statusList[TrainUsers::NO_APPROVED],
            ]
        ];
        $statusList[TrainUsers::ENROLL] = [
            'list' => [
                TrainUsers::DOING => TrainUsers::$statusList[TrainUsers::DOING]
            ]
        ];
        $statusList[TrainUsers::DOING] = [
            'list' => [
                TrainUsers::END => TrainUsers::$statusList[TrainUsers::END]
            ]
        ];
        $statusList[TrainUsers::END] = [
            'list' => [
                TrainUsers::END => TrainUsers::$statusList[TrainUsers::END]
            ]
        ];
        $statusList[TrainUsers::NO_APPROVED] = [
            'list' => [
                TrainUsers::APPROVED => TrainUsers::$statusList[TrainUsers::APPROVED]
            ]
        ];
        $statusList[TrainUsers::CANCEL] = [
            'list' => [
                TrainUsers::CANCEL => TrainUsers::$statusList[TrainUsers::CANCEL]
            ]
        ];
        $statusList[TrainUsers::PASS] = [
            'list' => [
                TrainUsers::PASS => TrainUsers::$statusList[TrainUsers::PASS]
            ]
        ];
        $statusList[TrainUsers::NO_PASS] = [
            'list' => [
                TrainUsers::NO_PASS => TrainUsers::$statusList[TrainUsers::NO_PASS]
            ]
        ];

        if (Yii::$app->request->isPost) {

            $updateParams = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();

            if ($model->load($updateParams) && $model->save()) {
                if ($updateParams['TrainUsers']['status'] == TrainUsers::END) {//如果结束状态，必须评分
                    if ($sourceStatus ==  TrainUsers::END) {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('请提交不同的状态！');
                    }
                    if ($updateParams['TrainUsers']['practice_score'] <= 0 || $updateParams['TrainUsers']['theory_score'] <= 0 || $updateParams['TrainUsers']['rule_score'] <= 0) {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('每项评分都必须大于零！');
                    }
                    if ($updateParams['TrainUsers']['practice_score'] > 100 || $updateParams['TrainUsers']['theory_score'] > 100 || $updateParams['TrainUsers']['rule_score'] > 100) {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('每项评分都不能超过100分！');
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
                            $trainPeriodNum = $trainInfo['period_num'];
                            $levelInfo = Level::findOne($model->level_id);
                            $certificateNumber = $this->getCertificateNumber($trainCode, $trainPeriodNum, sprintf("%04d", $model->orders), $levelInfo['code']);
                            $res = UsersLevel::updateAll(['status'=>1, 'certificate_number' => $certificateNumber, 'update_time' => date('Y-m-d H:i:s', time()), 'update_user' => Yii::$app->admin->identity->username], ['user_id' => $model->user_id, 'train_id' => $model->train_id]);
                            if ($res) {
                                //通过发短信
                                $content = "您好，您的培训课程考试已经通过，请进入教练员管理系统-我的课程查看。【教练系统】";
                                $result = $this->sendMessage($content,Messages::TRAIN_PASS,$model->user_id,$userInfo['mobile_phone'],'1');
                                if ($result != '0') {
                                    $transaction->rollBack();
                                    throw new ServerErrorHttpException('' . $result . '！');
                                } else {
                                    $transaction->commit();
                                    return $this->redirect(['view', 'id' => $model->id]);
                                }
                            } else {
                                $transaction->rollBack();
                                throw new ServerErrorHttpException(json_encode($res, JSON_UNESCAPED_UNICODE) . '！');
                            }

                        } else {
                            UsersLevel::updateAll(['status' => UsersLevel::TRAIN_NO_PASS], ['user_id' => $userInfo['id'],'train_id' => $model->train_id]);
                            //未通过发短信
                            $content = "尊敬的学员，您没有通过培训课程，谢谢！【教练系统】";
                            $result = $this->sendMessage($content,Messages::TRAIN_NO_PASS,$model->user_id,$userInfo['mobile_phone'],'1');
                            if ($result != '0') {
                                $transaction->rollBack();
                                throw new ServerErrorHttpException('' . $result . '！');
                            }
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    } else {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException(json_encode($model->errors, JSON_UNESCAPED_UNICODE) . '！');
                    }
                } else if($updateParams['TrainUsers']['status'] == TrainUsers::ENROLL) {
                    if ($sourceStatus ==  TrainUsers::ENROLL) {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('请提交不同的状态！');
                    }
                    //录取发短信
                    $content = "您好，很高兴的通知您，您报名的培训班已通过审核，请按指定日期前往培训地点缴费上课。【教练系统】";
                    $result = $this->sendMessage($content,Messages::TRAIN_SIGN_SUCCESS,$model->user_id,$userInfo['mobile_phone'],'1');
                    if ($result != '0') {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('' . $result . '！');
                    }
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } elseif($updateParams['TrainUsers']['status'] == TrainUsers::NO_APPROVED) {
                    if ($sourceStatus ==  TrainUsers::NO_APPROVED) {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('请提交不同的状态！');
                    }
                    //未通过审核发短信
                    $content = "尊敬的学员，您没有通过培训课程审核，谢谢！【教练系统】";
                    $result = $this->sendMessage($content,Messages::TRAIN_SIGN_ERROR,$model->user_id,$userInfo['mobile_phone'],'1');
                    if ($result != '0') {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('' . $result . '！');
                    }
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } elseif($updateParams['TrainUsers']['status'] == TrainUsers::DOING) {
                    if ($sourceStatus ==  TrainUsers::DOING) {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('请提交不同的状态！');
                    }
                    //培训开始发短信
                    $content = "尊敬的学员您好，您已缴费成功，请根据课培训班的课程安排按时上下课，谢谢！【教练系统】";
                    $result = $this->sendMessage($content,Messages::TRAIN_DOING,$model->user_id,$userInfo['mobile_phone'],'1');
                    if ($result != '0') {
                        $transaction->rollBack();
                        throw new ServerErrorHttpException('' . $result . '！');
                    }
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    if ($updateParams['TrainUsers']['practice_score'] != 0 || $updateParams['TrainUsers']['theory_score'] != 0 || $updateParams['TrainUsers']['rule_score'] != 0) {
                        throw new ServerErrorHttpException('只有更新结束状态需要评分！');
                    }
                    $transaction->commit();
                    Yii::$app->getSession()->setFlash('success', '更新成功！');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $transaction->rollBack();
                throw new ServerErrorHttpException('' . json_encode($model->errors, JSON_UNESCAPED_UNICODE) . '！');
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'statusList' => $statusList
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
            //得到最少的一项评分，用来计算成绩评价结果和判断是否通过
            $performanceSource = min($practiceScore,$theoryScore,$ruleScore);

            //获取评估
            foreach (TrainUsers::$assessRules as $k => $v) {
                if ($attendanceScore > $v['small'] && $attendanceScore <= $v['big']) {
                    //考勤结果
                    $attendanceComment = TrainUsers::$assessList[$k];
                }
                if ($scoreAppraise > $v['small'] && $scoreAppraise <= $v['big']) {
                    //评估总评
                    $commentAppraise = TrainUsers::$assessList[$k];
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
                //成绩评价结果
                if ($performanceSource > $v['small'] && $performanceSource <= $v['big']) {
                    //成绩评价结果
                    $performance = TrainUsers::$performanceList[$k];
                }
            }
            foreach (TrainUsers::$statusRules as $kk => $vv) {
                if ($performanceSource > $vv['small'] && $performanceSource <= $vv['big']) {
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

    public function getCertificateNumber($trainCode, $trainPeriodNum, $userOrder, $levelCode)
    {
        $certificateNumber = 'BJ' . $levelCode . $trainCode . $trainPeriodNum . $userOrder;
        return $certificateNumber;
    }

    public function actionUpdateStatus() {
        $status = Yii::$app->request->post('status');
        $idList = Yii::$app->request->post('selection');
        if (!empty($status) && !empty($idList)) {
            foreach ($idList as $key => $val) {
                TrainUsers::updateAll(['status' => $status], ['id' => $val]);
                if ($status == TrainUsers::ENROLL) {
                    $trainUsersInfo = TrainUsers::findOne($val);
                    //录取发送系统通知
                    $content = "您好，很高兴的通知您，您报名的培训班已通过审核，请按指定日期前往培训地点缴费上课。【教练系统】";
                    $userInfo = Users::findOne(['id' => $trainUsersInfo['user_id']]);
                    $result = $this->sendMessage($content,Messages::TRAIN_SIGN_SUCCESS,$trainUsersInfo['user_id'],$userInfo['mobile_phone'],'1');
                    if ($result != '0') {
                        throw new ServerErrorHttpException('' . $result . '！');
                    }
                }
                if ($status == TrainUsers::END) {
                    $trainUsersInfo = TrainUsers::findOne($val);
                    //结束发送系统通知
                    $content = "尊敬的学员，您参与的培训课程已经结束，请等待评分，谢谢！【教练系统】";
                    $userInfo = Users::findOne(['id' => $trainUsersInfo['user_id']]);
                    $result = $this->sendMessage($content,Messages::TRAIN_END,$trainUsersInfo['user_id'],$userInfo['mobile_phone'],'1');
                    if ($result != '0') {
                        throw new ServerErrorHttpException('' . $result . '！');
                    }
                }

            }
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            throw new ServerErrorHttpException('请选择评分信息！');
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
