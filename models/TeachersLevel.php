<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teachers_level".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $content
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 */
class TeachersLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teachers_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['name', 'code', 'create_user', 'update_user'], 'string', 'max' => 45],
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
            'content' => '说明',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    public static function getAll()
    {
        $result = [];
        $rows = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from(self::tableName())
            ->all();
        if (!empty($rows)) {
            foreach ($rows as $key => $val) {
                $result[$val['id']] = $val['name'];
            }
        }

        return $result;
    }

    public static function getNameById($id)
    {
        $sql = "SELECT name FROM " . self::tableName() . " WHERE id=" . $id;
        return Yii::$app->db->createCommand($sql)->queryScalar();
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
