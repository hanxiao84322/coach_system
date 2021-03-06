<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category
 * @property integer $level_id
 * @property integer $recruit_count
 * @property string $sign_up_begin_time
 * @property string $sign_up_end_time
 * @property integer $sign_up_status
 * @property string $begin_time
 * @property string $end_time
 * @property integer $status
 * @property string $content
 * @property integer $lesson
 * @property integer $score
 * @property string $address
 * @property string $launch
 * @property string $organizers
 * @property string $join_teams
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property Level $level
 * @property ActivityUsers[] $activityUsers
 */
class Activity extends \yii\db\ActiveRecord
{

    //分类
    const WEEKEND = 1;
    const DAILY = 2;

    static public $categoryList = [
        self::WEEKEND => '周末班',
        self::DAILY => '日常班'
    ];

    //课程状态
    const NEW_ADD = 1;
    const BEGIN_SIGN_UP = 2;
    const END_SIGN_UP = 3;
    const DOING = 4;
    const END = 5;

    static public $statusList = [
        self::NEW_ADD => '未开始报名',
        self::BEGIN_SIGN_UP => '报名开始',
        self::END_SIGN_UP => '报名结束',
        self::DOING => '进行中',
        self::END => '结束',
    ];

    public $already_recruit_count;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'level_id', 'recruit_count', 'sign_up_status', 'status', 'lesson', 'score'], 'integer'],
            [['sign_up_begin_time', 'sign_up_end_time', 'begin_time', 'end_time', 'create_time', 'update_time'], 'safe'],
            [['content','bus','near_site'], 'string'],
            [['name', 'create_user', 'update_user'], 'string', 'max' => 45],
            [['address', 'launch', 'organizers', 'join_teams'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'category' => '分类',
            'level_id' => '级别',
            'recruit_count' => '招收人数',
            'sign_up_begin_time' => '报名开始时间',
            'sign_up_end_time' => '报名结束时间',
            'sign_up_status' => '报名状态',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'status' => '状态',
            'lesson' => '课时',
            'address' => '地址',
            'score' => '活动积分',
            'launch' => '发起者',
            'organizers' => '主办方',
            'join_teams' => '参训着',
            'content' => '内容',
            'bus' => '公交路线',
            'near_site' => '周边站点',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityUsers()
    {
        return $this->hasMany(ActivityUsers::className(), ['activity_id' => 'id']);
    }

    public static function getAll()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from(self::tableName())
            ->where(['status'=>'1'])
            ->all();
        return $rows;
    }

    public static function getCategoryName($category)
    {
        return isset(self::$categoryList[$category]) ? self::$categoryList[$category] : $category;
    }

    public static function getSignUpStatusName($signUpStatus)
    {
        return isset(self::$signUpStatusList[$signUpStatus]) ? self::$signUpStatusList[$signUpStatus] : $signUpStatus;
    }

    public static function getStatusName($status)
    {
        return isset(self::$statusList[$status]) ? self::$statusList[$status] : $status;
    }

    public static  function getOneActivityNameById($activityId)
    {
        $sql = "SELECT name FROM `activity` WHERE id='" . $activityId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        return $result['name'];
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
