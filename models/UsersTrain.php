<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_train".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $credentials_number
 * @property string $begin_time
 * @property string $end_time
 * @property integer $level
 * @property string $address
 * @property string $witness
 * @property string $witness_phone
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 * @property string $update_user
 *
 * @property Users $user
 */
class UsersTrain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_train';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'level'], 'integer'],
            [['begin_time', 'end_time', 'create_time', 'update_time'], 'safe'],
            [['credentials_number'], 'string', 'max' => 25],
            [['address'], 'string', 'max' => 100],
            [['witness', 'update_user'], 'string', 'max' => 45],
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
            'user_id' => 'User ID',
            'credentials_number' => 'Credentials Number',
            'begin_time' => 'Begin Time',
            'end_time' => 'End Time',
            'level' => 'Level',
            'address' => 'Address',
            'witness' => 'Witness',
            'witness_phone' => 'Witness Phone',
            'description' => 'Description',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'update_user' => 'Update User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
