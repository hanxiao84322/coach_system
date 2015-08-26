<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $type
 * @property string $last_login_time
 * @property string $ip_address
 * @property integer $group_id
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property AdminGroup $group
 */
class Admin extends \yii\db\ActiveRecord
{

    //状态
    const GENERAL = 1; // 一般
    const SUPER = 2; // 超级

    static public $typeList = [
        self::GENERAL => '一般管理员',
        self::SUPER => '超级管理员'
    ];

    public $password_repeat;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'group_id'], 'integer'],
            [['username'], 'required'],
            ['email', 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message'=> '两次输入的密码不一致！'],
            [['username', 'password', 'ip_address', 'create_user', 'update_user'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'password_repeat' => '重复密码',
            'email' => '邮箱',
            'type' => '类型',
            'last_login_time' => '最后登录时间',
            'ip_address' => '登陆ip',
            'group_id' => '权限组',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }


    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $admin = (new \yii\db\Query())
            ->select(['*'])
            ->from(self::tableName())
            ->where('username=:username', [':username'=>$username])
            ->one();
        return new static($admin);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(AdminGroup::className(), ['id' => 'group_id']);
    }

    /*
     * get sex name
     */
    public static  function getTypeName($type)
    {
        return isset(self::$typeList[$type]) ? self::$typeList[$type] : $type;
    }


    public function beforeSave($insert = '')
    {
        if (parent::beforeSave($this->isNewRecord)) {
            if (isset($this->password)) {
                $this->password = md5($this->password);
            }
            if ($this->isNewRecord) {
                $this->create_time = date('Y-m-d H:i:s', time());
                $this->create_user = 'admin';
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
