<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teachers".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sex
 * @property integer $age
 * @property string $photo
 * @property integer $level
 * @property integer $status
 * @property integer $lesson
 * @property integer $score
 * @property string $register_district
 * @property string $certificate_number
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 */
class Teachers extends \yii\db\ActiveRecord
{
    const NEW_ADD = 0; // 待审核
    const APPROVED = 1; // 已审核
    const STOP = 2; // 暂停

    // 状态
    static public $statusList = [
        self::NEW_ADD => '待审核',
        self::APPROVED => '已审核',
        self::STOP => '暂停'
    ];

    const MAN = 1; // 男
    const WOMAN = 2; // 女
    //性别
    public static $sexList = [
        self::MAN => '男',
        self::WOMAN => '女',
    ];
    const LEVEL_A = 1; //亚足联A级教练员讲师
    const LEVEL_B = 2; //亚足联B级教练员讲师
    const LEVEL_C = 3; //亚足联C级教练员讲师
    const LEVEL_D = 4; //中国足协D级教练员讲师


    static public $levelList = [
        self::LEVEL_A => '亚足联A级教练员讲师',
        self::LEVEL_B => '亚足联B级教练员讲师',
        self::LEVEL_C => '亚足联C级教练员讲师',
        self::LEVEL_D => '中国足协D级教练员讲师',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'age', 'level','status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'photo', 'register_district', 'certificate_number', 'create_user', 'update_user'], 'string', 'max' => 45],
            [['content'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'sex' => '性别',
            'age' => '年龄',
            'photo' => '照片',
            'level' => '级别',
            'status' => '状态',
            'lesson' => '已授课时',
            'score' => '积分',
            'register_district' => '注册区域',
            'certificate_number' => '证件号码',
            'content' => '讲师简介',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    /*
     * get sex name
     */
    public static function getSexName($sex)
    {
        return isset(self::$sexList[$sex]) ? self::$sexList[$sex] : $sex;
    }
    /*
     * get level name
     */
    public static function getLevelName($level)
    {
        return isset(self::$levelList[$level]) ? self::$levelList[$level] : $level;
    }


    //获取级别
    public static function getAll()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from(self::tableName())
            ->all();
        return $rows;
    }


    public static  function getOneTeacherNameById($teacherId)
    {
        $sql = "SELECT name FROM " . self::tableName() . " WHERE id='" . $teacherId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        return $result['name'];
    }

    public static function getTeachersCount()
    {
        $sql = "SELECT count(*) as count FROM " . self::tableName();
        $result = Yii::$app->db->createCommand($sql)->queryScalar();
        return $result;
    }

    public static function getAllTeachersForNewsTrain()
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM  ' . self::tableName() . ' LIMIT 0 , 6 ')->queryAll();
        return $result;
    }

    public static function getAllTeachersForTeachersIndex()
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM  ' . self::tableName())->queryAll();
        return $result;
    }

    public static function getTeachersCountGroupByArea()
    {
        $result = Yii::$app->db->createCommand('SELECT count(t.id) as count,train.district FROM  ' . self::tableName() . ' t LEFT JOIN ' . TrainTeachers::tableName() . ' tt ON t.id = tt.teachers_id LEFT JOIN ' . Train::tableName() . ' train ON tt.train_id = train.id WHERE train.district is not null group by train.district')->queryAll();
        return $result;
    }

    public static function getStatusName($status)
    {
        return isset(self::$statusList[$status]) ? self::$statusList[$status] : $status;
    }

    public function beforeSave($insert = '')
    {
        if (parent::beforeSave($this->isNewRecord)) {
            if (isset($this->password)) {
                $this->password = md5($this->password);
            }
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
