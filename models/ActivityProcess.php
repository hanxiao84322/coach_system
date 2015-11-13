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

    const FINISH = 1;
    const NO_FINISH = 2;

    public static $statusList = [
        self::FINISH => '完成',
        self::NO_FINISH => '未完成'
    ];

    //扣分
    const NO_FINISH_SOURCE = 20;

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
        return 'activity_process';
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
        $count = Yii::$app->db->createCommand('SELECT count(*) as count FROM  ' . self::tableName() . '  WHERE activity_id=:activity_id AND user_id=:user_id AND status=:status', [':activity_id' => $activityId, ':user_id' => $userId, 'status' => $status])->queryScalar();
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }

    static public function getAllByActivityIdAndUserId($activityId, $userId)
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM  ' . self::tableName() . '  WHERE activity_id=:activity_id AND user_id=:user_id', [':activity_id' => $activityId, ':user_id' => $userId])->queryAll();
        return $result;
    }

    public static function getStatusName($status)
    {
        return isset(self::$statusList[$status]) ? self::$statusList[$status] : $status;
    }

}
