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

    const NO_TRAIN = 0; //未培训
    const TRAIN = 1; //已培训
    const REG = 2; //已注册
    const PAY = 3; //已缴费
    const SEND_CARD = 4; //已发证
    const LEVEL_UP = 5; //已晋升

    public static $statusList = [
        self::NO_TRAIN => '未培训',
        self::TRAIN => '已培训',
        self::REG => '已注册',
        self::PAY => '已缴费',
        self::SEND_CARD => '已发证',
        self::LEVEL_UP => '已晋升',
    ];


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
            'certificate_number' => '证件号码',
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

    public static function updateInfoForTrain($userId, $levelId, $trainId, $status, $certificateNumber, $district)
    {
        return Yii::$app->db->createCommand('UPDATE ' . self::tableName() . ' SET certificate_number = "' . $certificateNumber . '",district ="'  .  $district .'",status ="' . $status . '" ,train_id ="' . $trainId . '", credentials_number  WHERE user_id=:user_id AND level_id=:level_id', [':user_id' => $userId,':level_id' => $levelId])->execute();

    }

    public static function  getUserLevelAndScoreByUserIdLevelId($userId, $levelId)
    {
        $sql = "SELECT ul.*,tu.practice_score,tu.theory_score,tu.rule_score,tu.score_appraise FROM  " . self::tableName() ."  ul LEFT JOIN " . TrainUsers::tableName() . " tu ON ul.train_id = tu.train_id WHERE ul.user_id=:user_id AND ul.level_id = :level_id AND tu.status=8";
        $result = Yii::$app->db->createCommand($sql, [':user_id' => $userId, ':level_id' => $levelId])->queryOne();
        return $result;
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
            }
            return true;
        } else {
            return false;
        }
    }
}
