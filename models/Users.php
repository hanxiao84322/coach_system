<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $level_id
 * @property integer $level_order
 * @property integer $email_auth
 * @property integer $phone_auth
 * @property integer $status
 * @property string $mobile_phone
 * @property string $email
 * @property integer $lesson
 * @property integer $credit
 * @property integer $score
 * @property string $authKey
 * @property string $accessToken
 * @property string $create_time
 * @property string $update_time
 * @property string $update_user
 *
 * @property ActivityUsers[] $activityUsers
 * @property UsersEducation[] $usersEducations
 * @property UsersImage[] $usersImages
 * @property UsersLogin[] $usersLogins
 * @property UsersPlayers[] $usersPlayers
 * @property UsersTrain[] $usersTrains
 * @property UsersVocational[] $usersVocationals
 */
class Users extends \yii\db\ActiveRecord
{
    const NEW_ADD = 0; // 待审核
    const APPROVED = 1; // 已审核
    const NOT_APPROVED = 2; // 驳回
    const CLOSE = 3; // 关闭

    // 状态
    static public $statusList = [
        self::NEW_ADD => '待审核',
        self::APPROVED => '已审核',
        self::NOT_APPROVED => '驳回',
        self::CLOSE => '关闭'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level_id', 'level_order', 'email_auth', 'phone_auth', 'status', 'lesson', 'credit', 'score'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['password', 'update_user'], 'string', 'max' => 45],
            [['mobile_phone'], 'string', 'max' => 20],
            [['email', 'authKey', 'accessToken'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '姓名',
            'password' => '密码',
            'level_id' => '等级',
            'level_order' => '等级排序',
            'email_auth' => '邮箱验证',
            'phone_auth' => '电话验证',
            'status' => '状态',
            'mobile_phone' => '手机',
            'email' => 'Email',
            'lesson' => '参与课时',
            'credit' => '评分',
            'score' => '积分',
            'authKey' => '认证key',
            'accessToken' => '访问秘钥',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityUsers()
    {
        return $this->hasMany(ActivityUsers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersEducations()
    {
        return $this->hasMany(UsersEducation::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersImages()
    {
        return $this->hasMany(UsersImage::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersLogins()
    {
        return $this->hasMany(UsersLogin::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersPlayers()
    {
        return $this->hasMany(UsersPlayers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersTrains()
    {
        return $this->hasMany(UsersTrain::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersVocationals()
    {
        return $this->hasMany(UsersVocational::className(), ['user_id' => 'id']);
    }


    public static  function getOneUserNameById($userId)
    {
        $sql = "SELECT username FROM `users` WHERE id='" . $userId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        return $result['username'];
    }

    public static function getUserCountGroupByLevel()
    {
        $sql = "SELECT l.name as name,count(u.id) as count FROM `users` u RIGHT JOIN level l on u.level_id = l.id  group by u.level_id ";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function getStatusName($status)
    {
        return isset(self::$statusList[$status]) ? self::$statusList[$status] : $status;
    }

    public static function getAllCount()
    {
        $sql = "SELECT count(id) as count FROM `users`";
        $result = Yii::$app->db->createCommand($sql)->queryScalar();
        return $result;
    }

    public static function getAllCountByLevelId($levelId)
    {
        $sql = "SELECT count(id) as count FROM `users` WHERE level_id='" . $levelId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryScalar();
        return $result;
    }

    public static function getCountUserByLevelId($levelId, $count)
    {
        $sql = "SELECT u.level_id,ui.photo,ui.name,ui.birthday,u.id FROM " . self::tableName() . " u LEFT JOIN " . UsersInfo::tableName() . " ui ON u.id = ui.user_id WHERE u.level_id='" . $levelId . "' LIMIT 0," .$count;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    public function beforeSave($insert = '')
    {
        if (parent::beforeSave($this->isNewRecord)) {
            if (isset($this->password)) {
                $this->password = md5($this->password);
            }
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
