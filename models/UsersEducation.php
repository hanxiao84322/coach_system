<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_education".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $school
 * @property string $begin_time
 * @property string $end_time
 * @property string $address
 * @property integer $educational_background
 * @property string $witness
 * @property string $witness_phone
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 * @property string $update_user
 *
 * @property Users $user
 */
class UsersEducation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'educational_background'], 'integer'],
            [['begin_time', 'end_time', 'create_time', 'update_time'], 'safe'],
            [['school', 'witness', 'update_user'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 100],
            [['witness_phone'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'school' => '学校名称',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'address' => '地址',
                'educational_background' => '学历/学位',
                'witness' => '证明人',
                'witness_phone' => '证明人联系方式',
                'description' => '描述',
                'create_time' => '创建时间',
                'update_time' => '更新时间',
                'update_user' => '更新人',
            ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }


    public function beforeSave($insert = '')
    {
        if (parent::beforeSave($this->isNewRecord)) {
            if ($this->isNewRecord) {
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
