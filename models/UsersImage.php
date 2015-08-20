<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_image".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $level_id
 * @property string $photo
 * @property string $credentials_photo
 * @property string $create_time
 * @property string $update_time
 * @property string $update_user
 *
 * @property Users $user
 * @property Level $level
 */
class UsersImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'level_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['photo', 'credentials_photo'], 'string', 'max' => 50],
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
            'photo' => 'Photo',
            'credentials_photo' => 'Credentials Photo',
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
