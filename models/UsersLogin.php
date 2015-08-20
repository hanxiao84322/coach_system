<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_login".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $login_time
 * @property string $logout_time
 * @property string $ip_address
 *
 * @property Users $user
 */
class UsersLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_login';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['login_time', 'logout_time'], 'safe'],
            [['ip_address'], 'string', 'max' => 45]
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
            'login_time' => 'Login Time',
            'logout_time' => 'Logout Time',
            'ip_address' => 'Ip Address',
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
