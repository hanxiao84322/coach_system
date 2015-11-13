<?php

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;

/**
 * This is the model class for table "train_users".
 *
 * @property integer $id
 * @property integer $train_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $level_id
 * @property integer $orders
 * @property integer $practice_score
 * @property integer $theory_score
 * @property integer $rule_score
 * @property string $score_appraise
 * @property string $attendance_appraise
 * @property string $practice_comment
 * @property string $appraise_result
 * @property string $theory_comment
 * @property string $rule_comment
 * @property string $total_comment
 * @property string $result_comment
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property Train $train
 * @property Users $user
 */
class TrainUsers extends \yii\db\ActiveRecord
{

    const SIGN = 1; // 未完成申请
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
        self::SIGN => '未完成申请',
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

    public $trainName;
    public $userName;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'train_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['train_id', 'user_id', 'status', 'practice_score', 'theory_score', 'rule_score', 'level_id', 'orders'], 'integer'],
            [['status', 'practice_score', 'theory_score', 'rule_score'], 'required'],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'train_id' => '培训课程',
            'user_id' => '学员',
            'level_id' => '级别',
            'status' => '状态',
            'orders' => '序号',
            'practice_score' => '实践评分',
            'theory_score' => '理论评分',
            'rule_score' => '规则评分',
            'score_appraise' => '总评',
            'appraise_result' => '评价结果',
            'attendance_appraise' => '考勤评价',
            'practice_comment' => '实践评价',
            'theory_comment' => '理论评价',
            'rule_comment' => '规则评价',
            'total_comment' => '总评',
            'result_comment' => '评估结果',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrain()
    {
        return $this->hasOne(Train::className(), ['id' => 'train_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public static function getAllTrainByUserId($userId = '', $isPage = true)
    {
        $count = Yii::$app->db->createCommand('SELECT (tu.id) as count FROM  ' . self::tableName() . ' tu LEFT JOIN ' . Train::tableName() . ' t ON tu.train_id = t.id WHERE tu.user_id=:user_id ', [':user_id' => $userId])->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT tu.id as id,tu.train_id,t.name,t.category,t.create_time,t.address,t.recruit_count,tu.status,t.begin_time,tu.user_id as train_user_id,t.period_num,t.train_land_id FROM  ' . TrainUsers::tableName() . ' tu LEFT JOIN ' . Train::tableName() . ' t ON tu.train_id = t.id WHERE tu.user_id=:user_id  ORDER BY id desc',
            'params' => [':user_id' => $userId],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => $isPage ? '5' : '9999',
            ],
        ]);
        $models = $dataProvider->getModels();
        return $models;
    }

    public static function getTrainByUserId($userId = '')
    {
        $result = Yii::$app->db->createCommand('SELECT tu.train_id,t.name,tu.status,t.begin_time,tu.id FROM  ' . self::tableName() . ' tu LEFT JOIN ' . Train::tableName() . ' t ON tu.train_id = t.id WHERE tu.user_id=:user_id AND tu.status != ' . self::CANCEL . ' ORDER BY id desc ', [':user_id' => $userId])->queryOne();
        return $result;
    }


    public static function getTrainInfoById($id = '')
    {
        $result = Yii::$app->db->createCommand('SELECT *,tu.status as user_status FROM  ' . self::tableName() . ' tu LEFT JOIN ' . Train::tableName() . ' t ON tu.train_id = t.id WHERE tu.id=:id', [':id' => $id])->queryOne();
        return $result;
    }

    /*
     * 获取已录取的数
     */
    public static function getRecruitCount($trainId)
    {
        $count = Yii::$app->db->createCommand('SELECT count(*) FROM  ' . self::tableName() . '  WHERE train_id=:id AND status in ('. self::ENROLL .',' . self::DOING . ',' . self::END . ',' . self::PASS . ',' . self::NO_PASS . ')', [':id' => $trainId])->queryScalar();
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }


    /*
     * 获取已结业的数
     */
    public static function getPassCount($trainId)
    {
        $count = Yii::$app->db->createCommand('SELECT count(*) FROM  ' . self::tableName() . '  WHERE train_id=:id AND status = ' . self::PASS, [':id' => $trainId])->queryScalar();
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }

    public static function getApprovedTrainUsersByTrainId($trainId = '')
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM  ' . self::tableName() . '  WHERE train_id=:train_id AND status in ("' . self::ENROLL . '","' . self::DOING . '")', [':train_id' => $trainId])->queryAll();
        return $result;
    }

    public static function getDoingTrainUsersByTrainId($trainId = '')
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM  ' . self::tableName() . '  WHERE train_id=:train_id AND status in (' . self::DOING . ',' . self::END . ',' . self::PASS . ',' . self::NO_PASS . ')', [':train_id' => $trainId])->queryAll();
        return $result;
    }

    public static function updateTrainUsersStatusByTrainId($status, $train_id)
    {
        return Yii::$app->db->createCommand('UPDATE ' . self::tableName() . ' SET status =:status WHERE train_id=:train_id AND status != '.self::CANCEL, [':status' => $status,':train_id' => $train_id])->execute();
    }

    /**
     * @param $trainId.
     */
    public static function getAllUsersByTrainId($trainId)
    {
        $result = Yii::$app->db->createCommand('SELECT tu.train_id,u.name,u.photo,u.sex,tu.user_id,tu.score_appraise FROM  ' . self::tableName() . ' tu LEFT JOIN ' . UsersInfo::tableName() . ' u ON tu.user_id = u.user_id WHERE tu.train_id=:train_id', [':train_id' => $trainId])->queryAll();
        return $result;
    }

    public static function getAllTrainByUserIdAndLevel($userId = '', $LevelId = '')
    {
        $result = Yii::$app->db->createCommand('SELECT tu.id as id,tu.train_id,t.name,t.category,t.create_time,t.address,t.recruit_count,tu.status,t.begin_time,tu.user_id as train_user_id,t.period_num,t.train_land_id FROM  ' . TrainUsers::tableName() . ' tu LEFT JOIN ' . Train::tableName() . ' t ON tu.train_id = t.id WHERE tu.user_id=:user_id AND tu.level_id=:level_id  ORDER BY id desc', [':user_id' => $userId,':level_id' => $LevelId])->queryAll();
        return $result;
    }

    public static function getUserIsExistTrainStatus($userId, $LevelId)
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM  ' . self::tableName() . ' WHERE user_id=:user_id AND level_id=:level_id AND status in (' . TrainUsers::APPROVED . ',' . TrainUsers::PASS . ',' . TrainUsers::ENROLL . ',' . TrainUsers::DOING . ',' . TrainUsers::END . ',' . TrainUsers::PASS . ')', [':user_id' => $userId,':level_id' => $LevelId])->queryAll();
        return $result;

    }

    public static function getUserIsExistTrainStatusSign($userId, $LevelId)
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM ' . self::tableName() . ' WHERE user_id=:user_id AND level_id=:level_id AND status =' . self::SIGN, [':user_id' => $userId,':level_id' => $LevelId])->queryOne();
        return $result;

    }

    public static function getTrainUsersOrder($user_id = '',$train_id = '')
    {
        $result = Yii::$app->db->createCommand('SELECT orders FROM  ' . self::tableName() . ' WHERE user_id=:user_id AND train_id=:train_id', [':user_id' => $user_id,':train_id' => $train_id])->queryScalar();
        return $result;
    }

    public static function getMaxSignUpOrder($train_id = '')
    {
        $result = Yii::$app->db->createCommand('SELECT count(id) as max_count FROM  ' . self::tableName() . ' WHERE train_id=:train_id', [':train_id' => $train_id])->queryScalar();
        return $result;
    }

    public static function getAppraiseResultByUserIdAndLevelId($userId, $levelId)
    {
        $result = Yii::$app->db->createCommand('SELECT appraise_result FROM  ' . self::tableName() . ' WHERE user_id=:user_id AND level_id=:level_id', [':user_id' => $userId,':level_id' => $levelId])->queryScalar();
        return $result;
    }

    public static function getAllByCount($count)
    {
        $sql = "SELECT * FROM " . self::tableName() . " WHERE status >= " . self::ENROLL . " ORDER BY id DESC LIMIT 0," . $count;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
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
