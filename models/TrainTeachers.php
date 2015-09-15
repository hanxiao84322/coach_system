<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "train_teachers".
 *
 * @property integer $id
 * @property integer $train_id
 * @property integer $teachers_id
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 */
class TrainTeachers extends \yii\db\ActiveRecord
{
    public $trainName;
    public $trainId;
    public $teacherName;
    public $title;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'train_teachers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['train_id', 'teachers_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['create_user', 'update_user'], 'string', 'max' => 45]
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
            'teachers_id' => '讲师',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    /**
     * @param $trainId
     */
    public static function getAllTeachersByTrainId($trainId)
    {
        $result = Yii::$app->db->createCommand('SELECT tu.train_id,t.name,t.photo,t.age,t.sex,t.level,tu.teachers_id FROM  ' . self::tableName() . ' tu LEFT JOIN ' . Teachers::tableName() . ' t ON tu.teachers_id = t.id WHERE tu.train_id=:train_id', [':train_id' => $trainId])->queryAll();
        return $result;
    }

    public static function getAllTeachersForNewsTrain()
    {
        $result = Yii::$app->db->createCommand('SELECT * FROM  ' . self::tableName() . ' LIMIT 0 , 6 ')->queryAll();
        return $result;
    }

    public function beforeSave($insert = '')
    {
        if (parent::beforeSave($this->isNewRecord)) {
            if (isset($this->password)) {
                $this->password = md5($this->password);
            }
            if ($this->isNewRecord) {
                $this->title = 1;
                $this->create_time = date('Y-m-d H:i:s', time());
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
