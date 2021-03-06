<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property integer $id
 * @property string $name
 * @property integer $lesson
 * @property integer $credit
 * @property integer $score
 * @property integer $login_duration
 * @property string $register_fee
 * @property string $content
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property Activity[] $activities
 * @property Train[] $trains
 * @property UsersImage[] $usersImages
 * @property UsersLevel[] $usersLevels
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['score', 'login_duration','order','lesson','credit'], 'integer'],
            [[ 'score', 'login_duration','credit'], 'default', 'value' => 0],
            ['register_fee', 'default', 'value' => 0.00],

            [['register_fee'], 'number'],
            [['create_time', 'update_time'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['code'], 'string', 'max' => 5],
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
            'name' => '名称',
            'code' => '编码',
            'order' => '类别排序（越大级别越高，系统自动生成）',
            'score' => '升级所需一般活动积分',
            'lesson' => '升级所需课时',
            'credit' => '升级所需公益活动积分',
            'login_duration' => '升级所需注册时长单位月',
            'register_fee' => '注册费单位元',
            'content' => '录取条件',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrains()
    {
        return $this->hasMany(Train::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersImages()
    {
        return $this->hasMany(UsersImage::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersLevels()
    {
        return $this->hasMany(UsersLevel::className(), ['level_id' => 'id']);
    }

    //获取级别
    public static function getAll()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from(self::tableName())
            ->all();
        //删除注册学员的级别
        unset($rows[0]);
        return $rows;
    }

    //获取级别
    public static function getAllByEnd()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from(self::tableName())
            ->all();
        $first[''] = [
            'id' => '',
            'name'=>'选择级别'
        ];
        array_unshift($rows,$first);
        return $rows;
    }


    public static function getOneLevelNameById($levelId)
    {
        $row = (new \yii\db\Query())
            ->select(['name'])
            ->from(self::tableName())
            ->where('id=:id', [':id'=>$levelId])
            ->one();
        return $row['name'];
    }

    public static function getContentById($id)
    {
        $result = Yii::$app->db->createCommand('SELECT content FROM  ' . self::tableName() . ' WHERE id=:id', [':id' => $id])->queryOne();
        return $result['content'];
    }

    public static function getOneCodeById($levelId)
    {
        $sql = "SELECT code FROM " . self::tableName() . " WHERE id='" . $levelId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        return $result['code'];
    }

    public static function getOrderById($levelId)
    {
        $sql = "SELECT `order` FROM " . self::tableName() . " WHERE id='" . $levelId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryScalar();
        return $result;
    }

    public static function getRegisterFeeById($levelId)
    {
        $sql = "SELECT `register_fee` FROM " . self::tableName() . " WHERE id='" . $levelId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryScalar();
        return $result;
    }

    public static function getIdByName($name)
    {
        $result = Yii::$app->db->createCommand('SELECT id FROM  ' . self::tableName() . ' WHERE name=:name', [':name' => $name])->queryScalar();
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
