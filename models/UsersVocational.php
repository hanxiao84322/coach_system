<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_vocational".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $team
 * @property string $begin_time
 * @property string $end_time
 * @property integer $post
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
class UsersVocational extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_vocational';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'post'], 'integer'],
            [['begin_time', 'end_time', 'create_time', 'update_time'], 'safe'],
            [['team'], 'string', 'max' => 25],
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
            'team' => 'Team',
            'begin_time' => 'Begin Time',
            'end_time' => 'End Time',
            'post' => 'Post',
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
