<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property integer $id
 * @property integer $activity_id
 * @property integer $user_id
 * @property string $day
 * @property integer $status
 */
class ActivityProcess extends \yii\db\ActiveRecord
{

    const NORMAL = 1;
    const LATER = 2;
    const EARLY = 3;
    const ABSENCES = 4;
    const LEAVE = 5;

    public static $statusList = [
        self::NORMAL => '正常',
        self::LATER => '迟到',
        self::EARLY => '早退',
        self::ABSENCES => '旷课',
        self::LEAVE => '请假'
    ];

    //扣分
    const LATER_SOURCE = 20;
    const EARLY_SOURCE = 20;
    const ABSENCES_SOURCE = 50;
    const LEAVE_SOURCE = 10;

    //评估结果
    const EXCELLENT = 1;
    const GOOD = 2;
    const ERROR = 3;

    static public $assessList = [
        self::EXCELLENT => '优',
        self::GOOD => '良',
        self::ERROR => '差',
    ];

    static public $assessRules = [
        self::EXCELLENT => [
            'small' => 0,
            'big' => 60
        ],
        self::GOOD => [
            'small' => 61,
            'big' => 80
        ],
        self::ERROR => [
            'small' => 81,
            'big' => 100
        ],
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'user_id', 'status'], 'integer'],
            [['day'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => '课程',
            'user_id' => '学员',
            'day' => '日期',
            'status' => '状态',
        ];
    }

    static public function add($info = [])
    {
        $sql = 'INSERT INTO ' . self::tableName() . ' (activity_id,user_id,day) VALUES ("' . $info['activity_id'] . '","' . $info['user_id'] . '","' . $info['day'] . '")';
        return Yii::$app->db->createCommand($sql)->query();
    }

    static public function getCount($activityId, $userId, $status)
    {
        $count = Yii::$app->db->createCommand('SELECT count(*) FROM  ' . self::tableName() . '  WHERE activity_id=:activity_id AND user_id=:user_id AND status=:status', [':activity_id' => $activityId, ':user_id' => $userId, 'status' => $status])->queryScalar();
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }

    static public function getAllByactivityIdAndUserId($activityId, $userId)
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM  ' . self::tableName() . '  WHERE activity_id=:activity_id AND user_id=:user_id', [':activity_id' => $activityId, ':user_id' => $userId])->queryAll();
        return $result;
    }

    public static function getStatusName($status)
    {
        return isset(self::$statusList[$status]) ? self::$statusList[$status] : $status;
    }

}
