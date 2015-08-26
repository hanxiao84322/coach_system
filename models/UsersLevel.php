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
            'user_id' => '用户名',
            'level_id' => '级别',
            'certificate_number' => '证件号码哦',
            'district' => '所属区域',
            'receive_address' => '收货地址',
            'postcode' => '邮编',
            'is_pay' => '是否支付',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }
}
