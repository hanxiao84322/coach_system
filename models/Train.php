<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "train".
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
 * @property integer $lesson
 * @property string $address
 * @property string $content
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property Level $level
 * @property TrainUsers[] $trainUsers
 */
class Train extends \yii\db\ActiveRecord
{

    //分类
    const WEEKEND = 1;
    const FULLTIME = 2;
    const BIGWEEKEND = 3;


    static public $categoryList = [
        self::WEEKEND => '周末班',
        self::FULLTIME => '脱产班',
        self::BIGWEEKEND => '大周末班',


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

    static public $districtList = [
        '东城区' => '东城区',
        '西城区' => '西城区',
        '朝阳区' => '朝阳区',
        '丰台区' => '丰台区',
        '石景山区' => '石景山区',
        '海淀区' => '海淀区',
        '门头沟区' => '门头沟区',
        '房山区' => '房山区',
        '通州区' => '通州区',
        '顺义区' => '顺义区',
        '昌平区' => '昌平区',
        '大兴区' => '大兴区',
        '怀柔区' => '怀柔区',
        '平谷区' => '平谷区',
        '密云县' => '密云县',
        '延庆县' => '延庆县',
        '其他区' => '其他区',
    ];

    //以招收人数
    public $already_recruit_count;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'train';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'level_id', 'recruit_count', 'status', 'lesson','code'], 'integer'],
            [['category', 'level_id', 'recruit_count', 'status', 'lesson','code'], 'required'],
            [['sign_up_begin_time', 'sign_up_end_time', 'begin_time', 'end_time', 'create_time', 'update_time'], 'safe'],
            [['content', 'district'], 'string'],
            [['name', 'create_user', 'update_user','bus', 'near_site'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 50]
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
            'code' => '编号',
            'recruit_count' => '招收人数',
            'sign_up_begin_time' => '报名开始时间',
            'sign_up_end_time' => '报名结束时间',
            'sign_up_status' => '报名状态',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'district' => '所在区域',
            'status' => '状态',
            'lesson' => '课时',
            'address' => '地址',
            'bus' => '公交路线',
            'near_site' => '附近站点',
            'content' => '内容',
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
    public function getTrainUsers()
    {
        return $this->hasMany(TrainUsers::className(), ['train_id' => 'id']);
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

    /*
     * 根据级别group by活动
     */
    public static function getTrainByLevel($levelId)
    {
        $sql = "SELECT * FROM `train` WHERE level_id='" . $levelId . "'";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static  function getOneTrainNameById($trainId)
    {
        $sql = "SELECT name FROM `train` WHERE id='" . $trainId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        return $result['name'];
    }

    public static function getOneCodeById($trainId)
    {
        $sql = "SELECT code FROM `train` WHERE id='" . $trainId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        return $result['code'];
    }


    public static function getOneDistrictById($trainId)
    {
        $sql = "SELECT district FROM `train` WHERE id='" . $trainId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        return $result['district'];
    }


    public static function getTrainCount()
    {
        $sql = "SELECT count(*) as count FROM " . self::tableName();
        $result = Yii::$app->db->createCommand($sql)->queryScalar();
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
