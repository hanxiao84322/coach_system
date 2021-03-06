<?php

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;

/**
 * This is the model class for table "activity_users".
 *
 * @property integer $id
 * @property integer $activity_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $practice_score
 * @property integer $theory_score
 * @property integer $rule_score
 * @property string $score_appraise
 * @property string $attendance_appraise
 * @property string $practice_comment
 * @property string $theory_comment
 * @property string $rule_comment
 * @property string $total_comment
 * @property string $result_comment
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property Activity $activity
 * @property Users $user
 */
class ActivityUsers extends \yii\db\ActiveRecord
{

    const SIGN = 1; // 已报名
    const APPROVED = 2; // 审核中
    const ENROLL = 3; // 已录取
    const DOING = 4; // 进行中
    const END = 5; // 结束
    const NO_APPROVED = 6; // 审核未通过
    const CANCEL = 7; // 取消
    const PASS = 8; // 通过
    const NO_PASS = 9; // 未通过


    // 状态
    static public $statusList = [
        self::SIGN => '已报名',
        self::APPROVED => '审核中',
        self::ENROLL => '已录取',
        self::DOING => '进行中',
        self::END => '结束',
        self::NO_APPROVED => '审核未通过',
        self::CANCEL => '取消',
        self::PASS => '通过',
        self::NO_PASS => '未通过',
    ];

    //成绩评价结果
    const RECOMMEND = 1;
    const PRACTICE = 2;
    const CURRENT = 4;
    const PASSING = 5;
    const NO_PASSING = 3;

    static public $performanceList = [
        self::RECOMMEND => '推荐晋级',
        self::PRACTICE => '实践1年推荐晋级',
        self::CURRENT => '仅限当前级',
        self::PASSING => '通过',
        self::NO_PASSING => '未通过'
    ];


    //评估结果适用于考勤
    const EXCELLENT = 1;
    const GOOD = 2;
    const ERROR = 3;

    static public   $assessList = [
        self::EXCELLENT => '优',
        self::GOOD => '良',
        self::ERROR => '差',
    ];

    static public $assessRules = [
        self::EXCELLENT => [
            'small' => 79,
            'big' => 100
        ],
        self::GOOD => [
            'small' => 59,
            'big' => 79
        ],
        self::ERROR => [
            'small' => 0,
            'big' => 59
        ],
    ];

    static public $statusRules = [
        self::PASS => [
            'small' => 59,
            'big' => 100
        ],
        self::NO_PASS => [
            'small' => 0,
            'big' => 59
        ]
    ];

    public $activityName;
    public $userName;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'user_id', 'status', 'practice_score', 'theory_score', 'rule_score'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['attendance_appraise', 'practice_comment', 'theory_comment', 'rule_comment', 'total_comment', 'create_user', 'update_user'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => '活动',
            'user_id' => '教练员',
            'status' => '状态',
            'practice_score' => '实践得分',
            'theory_score' => '理论得分',
            'rule_score' => '规则得分',
            'score_appraise' => '活动积分',
            'appraise_result' => '获得积分',
            'attendance_appraise' => '活动进程',
            'practice_comment' => '实践评估',
            'theory_comment' => '理论评估',
            'rule_comment' => '规则评估',
            'total_comment' => '总评',
            'result_comment' => '最终评分',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activity::className(), ['id' => 'activity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public static function getAllActivityByUserId($userId = '', $isPage = true)
    {
        $count = Yii::$app->db->createCommand('SELECT (au.id) as count FROM  ' . self::tableName() . ' au LEFT JOIN ' . Activity::tableName() . ' a ON au.activity_id = a.id WHERE au.user_id=:user_id', [':user_id' => $userId])->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT au.id as id,au.activity_id,a.name,a.category,a.create_time,a.address,a.lesson,a.score,au.status,a.begin_time,a.recruit_count FROM  ' . self::tableName() . ' au LEFT JOIN ' . Activity::tableName() . ' a ON au.activity_id = a.id WHERE au.user_id=:user_id',
            'params' => [':user_id' => $userId],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => $isPage ? '5' : '9999',
            ],
        ]);
        $models = $dataProvider->getModels();
        return $models;

    }

    public static function getApprovedActivityUsersByActivityId($activityId = '')
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM  ' . self::tableName() . '  WHERE activity_id=:activity_id AND status in ("' . self::ENROLL . '","' . self::DOING . '")', [':activity_id' => $activityId])->queryAll();
        return $result;
    }


    public static function updateActivityUsersStatusByActivityId($status, $activityId)
    {
        return Yii::$app->db->createCommand('UPDATE ' . self::tableName() . ' SET status =:status WHERE activity_id=:activity_id AND status != '.self::CANCEL, [':status' => $status,':activity_id' => $activityId])->execute();
    }

    public function getEnrollCountByActivityId($activity_id)
    {
        $result = Yii::$app->db->createCommand('SELECT count(*) as count FROM  ' . self::tableName() . '  WHERE activity_id=:activity_id AND status in ("' . self::ENROLL . '","' . self::DOING . '")', [':activity_id' => $activity_id])->queryScalar();
        return $result;
    }

    public function getPassCountByActivityId($activity_id)
    {
        $result = Yii::$app->db->createCommand('SELECT count(*) as count FROM  ' . self::tableName() . '  WHERE activity_id=:activity_id AND status  = "' . self::DOING . '"', [':activity_id' => $activity_id])->queryScalar();
        return $result;
    }

    public function getAllInfoById($activityId) {
        $result = Yii::$app->db->createCommand('SELECT u.username,u.score,uf.birthday,u.level_id,uf.photo FROM  ' . self::tableName() . ' au LEFT JOIN ' . UsersInfo::tableName() . ' uf ON au.user_id = uf.id LEFT JOIN ' . Users::tableName() . ' u ON au.user_id = u.id WHERE au.activity_id=:activity_id', [':activity_id' => $activityId])->queryAll();
        return $result;
    }

    public static function getUserIsExistActivityStatus($userId, $LevelId)
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM  ' . self::tableName() . ' WHERE user_id=:user_id AND level_id=:level_id AND status not in (' . ActivityUsers::NO_APPROVED . ',' . ActivityUsers::NO_PASS . ',' . ActivityUsers::CANCEL . ')', [':user_id' => $userId,':level_id' => $LevelId])->queryAll();
        return $result;

    }

    public static function getActivityUsersOrder($userId = '', $activity_id = '')
    {
        $result = Yii::$app->db->createCommand('SELECT max(orders) as max_order FROM  ' . self::tableName() . ' WHERE user_id=:user_id AND activity_id=:activity_id', [':user_id' => $userId,':activity_id' => $activity_id])->queryScalar();
        return $result;
    }

    public static function getMaxSignUpOrder($activity_id = '')
    {
        $result = Yii::$app->db->createCommand('SELECT count(id) as max_count FROM  ' . self::tableName() . ' WHERE activity_id=:activity_id', [':activity_id' => $activity_id])->queryScalar();
        return $result;
    }


    public static function getActivityByUserId($userId = '')
    {
        $result = Yii::$app->db->createCommand('SELECT au.activity_id,a.name,au.status,a.begin_time,au.id FROM  ' . self::tableName() . ' au LEFT JOIN ' . Activity::tableName() . ' a ON au.activity_id = a.id WHERE au.user_id=:user_id AND au.status != ' . self::CANCEL, [':user_id' => $userId])->queryOne();
        return $result;
    }

    public static function getAllActivityByUserIdAndLevel($userId = '', $LevelId = '')
    {
        $result = Yii::$app->db->createCommand('SELECT *,au.status as user_status,au.id as activity_user_id FROM  ' . self::tableName() . ' au LEFT JOIN ' . Activity::tableName() . ' a ON au.activity_id = a.id WHERE au.user_id=:user_id AND au.level_id=:level_id', [':user_id' => $userId,':level_id' => $LevelId])->queryAll();
        return $result;
    }


    public static function getActivityInfoById($id = '')
    {
        $result = Yii::$app->db->createCommand('SELECT *,au.status as user_status FROM  ' . self::tableName() . ' au LEFT JOIN ' . Activity::tableName() . ' a ON au.activity_id = a.id WHERE au.activity_id=:id', [':id' => $id])->queryOne();
        return $result;
    }

    public static function getAllUsersByActivityId($activityId)
    {
        $result = Yii::$app->db->createCommand('SELECT au.activity_id,u.name,u.photo,u.sex,au.user_id,au.score_appraise FROM  ' . self::tableName() . ' tu LEFT JOIN ' . UsersInfo::tableName() . ' u ON au.user_id = u.id WHERE au.activity_id=:activity_id', [':activity_id' => $activityId])->queryAll();
        return $result;
    }

    /*
     * 获取已结业的数
     */
    public static function getPassCount($activityId)
    {
        $count = Yii::$app->db->createCommand('SELECT count(*) FROM  ' . self::tableName() . '  WHERE activity_id=:id AND status = ' . self::PASS, [':id' => $activityId])->queryScalar();
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }


    /*
     * 获取已录取的数
     */
    public static function getRecruitCount($activityId)
    {
        $count = Yii::$app->db->createCommand('SELECT count(*) FROM  ' . self::tableName() . '  WHERE activity_id=:id AND status in ('. self::ENROLL .',' . self::APPROVED . ',' . self::DOING . ',' . self::END . ',' . self::PASS . ',' . self::NO_PASS . ')', [':id' => $activityId])->queryScalar();
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }

    public function beforeSave($insert = '')
    {
        if (parent::beforeSave($this->isNewRecord)) {
            if ($this->isNewRecord) {
                $this->create_time = date('Y-m-d H:i:s', time());
                $this->create_user = 'admin';
                $this->update_time = date('Y-m-d H:i:s', time());
                $this->update_user = 'admin';
            } else {
                $this->update_time = date('Y-m-d H:i:s', time());
                $this->update_user = 'admin';
            }
            return true;
        } else {
            return false;
        }
    }
}
