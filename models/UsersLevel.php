<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_level".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $level_id
 * @property string $certificate_number
 * @property string $district
 * @property string $receive_address
 * @property string $postcode
 * @property integer $is_pay
 * @property string $create_time
 * @property string $update_time
 * @property string $update_user
 *
 * @property Users $user
 * @property Level $level
 */
class UsersLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'level_id', 'is_pay'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['certificate_number'], 'string', 'max' => 25],
            [['district', 'postcode'], 'string', 'max' => 10],
            [['receive_address'], 'string', 'max' => 100],
            [['update_user'], 'string', 'max' => 45]
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
            'level_id' => 'Level ID',
            'certificate_number' => 'Certificate Number',
            'district' => 'District',
            'receive_address' => 'Receive Address',
            'postcode' => 'Postcode',
            'is_pay' => 'Is Pay',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }
}
