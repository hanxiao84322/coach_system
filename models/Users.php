<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property integer $sex
 * @property string $birthday
 * @property integer $title
 * @property integer $status
 * @property integer $credentials_type
 * @property string $credentials_number
 * @property string $account_location
 * @property string $telephone
 * @property string $mobile_phone
 * @property string $email
 * @property integer $height
 * @property integer $weight
 * @property integer $disease_history
 * @property string $contact_address
 * @property string $contact_postcode
 * @property string $company_name
 * @property string $company_address
 * @property string $company_postcode
 * @property string $company_contact_phone
 * @property integer $clothes_size
 * @property integer $t_shirt_size
 * @property integer $shorts_size
 * @property integer $language
 * @property integer $spoken_language
 * @property integer $write_language
 * @property integer $lesson
 * @property integer $credit
 * @property integer $score
 * @property string $create_time
 * @property string $update_time
 * @property string $update_user
 *
 * @property ActivityUsers[] $activityUsers
 * @property News[] $news
 * @property TrainUsers[] $trainUsers
 * @property UsersEducation[] $usersEducations
 * @property UsersImage[] $usersImages
 * @property UsersLevel[] $usersLevels
 * @property UsersLogin[] $usersLogins
 * @property UsersPlayers[] $usersPlayers
 * @property UsersTrain[] $usersTrains
 * @property UsersVocational[] $usersVocationals
 */
class Users extends \yii\db\ActiveRecord
{

    const MAN = 1; // 男
    const WOMAN = 2; // 女
    //性别
    public static $sexList = [
        self::MAN => '男',
        self::WOMAN => '女',
    ];

    const TEACHER = 1; // 一般用户
    const STUDENT = 2; //讲师
    //性别
    public static $titleList = [
        self::TEACHER => '一般用户',
        self::STUDENT => '讲师',
    ];


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

    const ID_CARD = 1; // 身份证
    const DRIVER_LICENSE = 2; // 驾驶证

    // 状态
    static public $credentialsType = [
        self::ID_CARD => '身份证',
        self::DRIVER_LICENSE => '驾驶证'
    ];

    //既往病史
    const YES = 1; // 有
    const NO = 2; // 没有

    public static $diseaseHistory = [
        self::YES => '有',
        self::NO => '没有',
    ];

    //尺码
    const S = 1;
    const M = 2;
    const L = 3;
    const XL = 4;
    const XXL = 5;

    public static $sizeList = [
        self::S => 'S',
        self::M => 'M',
        self::L => 'L',
        self::XL => 'XL',
        self::XXL => 'XXL'
    ];

    //外语
    const ENGLISH = 1; // 英语
    const GERMAN = 2; // 德语

    public static $languageList = [
        self::ENGLISH => '英语',
        self::GERMAN => '德语',
    ];

    //会话,写作能力
    const PROFICIENT = 1; // 精通
    const GOOD = 2; // 良好
    const GENERAL = 3; //一般

    public static $abilityList = [
        self::PROFICIENT => '精通',
        self::GOOD => '良好',
        self::GENERAL => '一般',

    ];

    public $password_repeat;

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
            [['name', 'password','sex', 'status', 'credentials_type', 'credentials_number', 'account_location','telephone', 'mobile_phone', 'email', 'height', 'weight', 'disease_history', 'contact_address','company_name', 'company_address', 'company_contact_phone', 'clothes_size', 't_shirt_size', 'shorts_size', 'language', 'spoken_language', 'write_language', 'birthday'], 'required'],
            [['height', 'weight','telephone', 'mobile_phone'], 'integer'],
            ['email', 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message'=> '两次输入的密码不一致！'],
            [['name', 'company_name'], 'string', 'max' => 20,'min' => 2],
            [['password'], 'string', 'max' => 18,'min' => 6],
            [['credentials_number'], 'string', 'max' => 19,'min' => 18],
            [['telephone', 'mobile_phone', 'company_contact_phone'], 'string', 'max' => 20,'min' => 8],
            [['email', 'contact_address', 'company_address'], 'string', 'max' => 100,'min' => 2],
            [['contact_postcode', 'company_postcode'], 'string', 'max' => 7, 'min' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'password' => '密码',
            'password_repeat' => '重复密码',
            'sex' => '性别',
            'birthday' => '生日',
            'title' => '类型',
            'status' => '状态',
            'credentials_type' => '证件类型',
            'credentials_number' => '证件号码',
            'account_location' => '户口所在地',
            'telephone' => '联系座机',
            'mobile_phone' => '联系手机',
            'email' => 'Email',
            'height' => '身高 (单位CM)',
            'weight' => '体重 (单位KG)',
            'disease_history' => '既往病史',
            'contact_address' => '联系地址',
            'contact_postcode' => '联系邮编',
            'company_name' => '公司名称',
            'company_address' => '公司地址',
            'company_postcode' => '公司邮编',
            'company_contact_phone' => '公司联系电话',
            'clothes_size' => '训练服尺码',
            't_shirt_size' => '训练T恤尺码',
            'shorts_size' => '训练鞋尺码',
            'language' => '外语',
            'spoken_language' => '会话能力',
            'write_language' => '写作能力',
            'lesson' => '课时',
            'credit' => '学分',
            'score' => '综合评分',
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
    public function getNews()
    {
        return $this->hasMany(News::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainUsers()
    {
        return $this->hasMany(TrainUsers::className(), ['user_id' => 'id']);
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
    public function getUsersLevels()
    {
        return $this->hasMany(UsersLevel::className(), ['user_id' => 'id']);
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

    /*
     * get sex name
     */
    public function getSexName($sex)
    {
        return isset(self::$sexList[$sex]) ? self::$sexList[$sex] : $sex;
    }

    /*
     * get sex name
     */
    public function getTitleName($title)
    {
        return isset(self::$sexList[$title]) ? self::$titleList[$title] : $title;
    }

    public function getStatusName($status)
    {
        return isset(self::$statusList[$status]) ? self::$statusList[$status] : $status;
    }

    public function getCredentialsName($credentialsType)
    {
        return isset(self::$credentialsType[$credentialsType]) ? self::$credentialsType[$credentialsType] : $credentialsType;
    }

    public function getDiseaseHistoryName($diseaseHistory)
    {
        return isset(self::$diseaseHistory[$diseaseHistory]) ? self::$diseaseHistory[$diseaseHistory] : $diseaseHistory;
    }

    public function getSizeName($size)
    {
        return isset(self::$sizeList[$size]) ? self::$sizeList[$size] : $size;
    }

    public function getLanguageName($language)
    {
        return isset(self::$languageList[$language]) ? self::$languageList[$language] : $language;
    }

    public function getAbilityName($ability)
    {
        return isset(self::$abilityList[$ability]) ? self::$abilityList[$ability] : $ability;
    }


    public function beforeSave()
    {
        if (parent::beforeSave(true)) {
            if (isset($this->password)) {
                $this->password = md5($this->password);
            }
            if ($this->isNewRecord) {
                $this->title = 1;
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
