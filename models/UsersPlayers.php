<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_players".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $team
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
class UsersPlayers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_players';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'level'], 'integer'],
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
            'user_id' => '用户ID',
            'team' => '效力球队',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'level' => '级别',
            'address' => '地址',
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
}
