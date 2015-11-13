<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_level".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $level_id
 * @property integer $train_id
 * @property string $certificate_number
 * @property string $credentials_number
 * @property string $district
 * @property string $status
 * @property string $end_date
 * @property string $receive_address
 * @property string $postcode
 * @property integer $is_pay
 * @property string $create_time
 * @property string $update_time
 * @property string $update_user
 * @property string $photo
 * @property string $credentials_photo
 *
 * @property Users $user
 * @property Level $level
 */
class UsersLevel extends \yii\db\ActiveRecord
{

    const NO_TRAIN = 0; //未培训
    const TRAIN = 1; //已培训
    const REG = 2; //验证
    const PAY = 3; //待审核
    const SEND_CARD = 4; //注册
    const LEVEL_UP = 5; //已晋升
    const TRAIN_NO_PASS = 6;//培训未通过

    public static $statusList = [
        self::NO_TRAIN => '未培训',
        self::TRAIN => '已培训',
        self::REG => '已验证',
        self::PAY => '待审核',
        self::SEND_CARD => '已注册',
        self::LEVEL_UP => '已晋升',
        self::TRAIN_NO_PASS => '培训未通过',
    ];

    const ONLINE = 2;
    const UNLINE = 1;

    public static  $payTypeList = [
        self::ONLINE => '在线支付',
        self::UNLINE => '线下支付',
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
            [['user_id', 'level_id', 'is_pay', 'status'], 'integer'],
            [['create_time','end_date', 'update_time'], 'safe'],
            [['certificate_number'], 'string', 'max' => 25],
            [['district', 'postcode'], 'string', 'max' => 10],
            [['receive_address'], 'string', 'max' => 100],
            [['update_user'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'train_id' => '参加培训课程',
            'user_id' => '用户名',
            'level_id' => '级别',
            'certificate_number' => '证件号码',
            'district' => '所属区域',
            'receive_address' => '收货地址',
            'end_date' => '到期时间',
            'postcode' => '邮编',
            'is_pay' => '是否支付',
            'status' => '状态',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'update_user' => '更新人',
            'photo' => '形象照',
            'credentials_photo' => '证件照',
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
        $sql = "SELECT ul.*,tu.practice_score,tu.theory_score,tu.rule_score,tu.score_appraise,ui.photo,ui.account_location,ui.contact_address,ui.contact_postcode,ul.photo as user_level_photo FROM  " . self::tableName() ."  ul LEFT JOIN " . TrainUsers::tableName() . " tu ON ul.train_id = tu.train_id AND ul.user_id = tu.user_id  LEFT JOIN " . UsersInfo::tableName() . " ui ON ui.user_id = ul.user_id WHERE ul.user_id=:user_id AND ul.level_id = :level_id AND ul.status in (" . UsersLevel::REG . ",". UsersLevel::PAY .",". UsersLevel::SEND_CARD .",". UsersLevel::LEVEL_UP .") AND tu.status = " . TrainUsers::PASS;
        $result = Yii::$app->db->createCommand($sql, [':user_id' => $userId, ':level_id' => $levelId])->queryOne();
        return $result;
    }

    public static function getLevelCertificateNumberByUserIdAndLevelId($userId, $levelId)
    {
        $sql = "SELECT certificate_number FROM " . self::tableName() . " WHERE user_id =:user_id AND level_id=:level_id";
        $result = Yii::$app->db->createCommand($sql, [':user_id' => $userId, ':level_id' => $levelId])->queryScalar();
        return $result;
    }

    public static function getStatusName($status)
    {
        return !empty(self::$statusList[$status]) ? self::$statusList[$status] : '';
    }

    public static function getLevelUpInfoByUserIdOrder($userId, $levelOrder)
    {
        $sql = "SELECT u.score,u.lesson,u.credit,u.create_time,l.credit as level_credit,l.score as level_score,l.name,l.login_duration,l.content FROM " . self::tableName() . " ul LEFT JOIN " . Users::tableName() . " u ON ul.user_id = u.id LEFT JOIN " . Level::tableName() . " l ON ul.level_id = l.id WHERE ul.user_id=:user_id AND l.order=:level_order";
        $result = Yii::$app->db->createCommand($sql, [':user_id' => $userId, ':level_order' => $levelOrder])->queryOne();
        return $result;

    }

    public static function getStatusByUserIdAndLevelId($userId, $levelId)
    {
        $result = Yii::$app->db->createCommand('SELECT status FROM  ' . self::tableName() . ' WHERE user_id=:user_id AND level_id=:level_id', [':user_id' => $userId,':level_id' => $levelId])->queryScalar();
        return self::$statusList[$result];
    }

    public static  function getStatusOrderByIdAsc($userId)
    {
        $sql = "SELECT status FROM " . self::tableName() . " WHERE user_id=:user_id  ORDER BY id asc LIMIT 0,1 ";
        $result = Yii::$app->db->createCommand($sql, [':user_id' => $userId])->queryScalar();
        return $result;
    }

    public static function getUserTrainInfo($id)
    {
        $sql = "SELECT t.begin_time,t.end_time,tl.address,ul.level_id,ul.certificate_number,tt.teachers_id,ul.user_id,t.content
              FROM
               users_level ul
         LEFT JOIN
    train t ON ul.train_id = t.id
        LEFT JOIN
    train_land tl ON tl.id = t.train_land_id
        LEFT JOIN
    train_teachers tt ON tt.train_id = t.id
WHERE
    ul.id = :id
LIMIT 0 , 1";
        $result = Yii::$app->db->createCommand($sql, [':id' => $id])->queryOne();
        return $result;

    }


    public static function getAllByCount($count)
    {
        $sql = "SELECT * FROM " . self::tableName() . " WHERE status = " . self::SEND_CARD . " OR status = " . self::LEVEL_UP . " ORDER BY id desc LIMIT 0," . $count;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
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
