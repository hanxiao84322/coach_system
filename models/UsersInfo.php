<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_info".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $sex
 * @property string $birthday
 * @property integer $credentials_type
 * @property string $credentials_number
 * @property string $account_location
 * @property string $telephone
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
 * @property string $photo
 * @property string $credentials_photo
 */
class UsersInfo extends \yii\db\ActiveRecord
{


    const MAN = 1; // 男
    const WOMAN = 2; // 女
    //性别
    public static $sexList = [
        self::MAN => '男',
        self::WOMAN => '女',
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


    //既往病史
    const YES = 1; // 没有
    const NO = 2; // 有

    public static $diseaseHistory = [
        self::YES => '没有',
        self::NO => '有',
    ];

    const ID_CARD = 1; // 身份证
    const DRIVER_LICENSE = 2; // 驾驶证

    // 状态
    static public $credentialsType = [
        self::ID_CARD => '身份证',
        self::DRIVER_LICENSE => '驾驶证'
    ];


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'credentials_type', 'height', 'weight', 'disease_history', 'clothes_size', 't_shirt_size', 'shorts_size' ], 'required'],
            [['birthday'], 'safe'],
            [['user_id'], 'integer'],
            [['name', 'photo', 'credentials_photo'], 'string', 'max' => 45],
            [['credentials_number'], 'string', 'max' => 25],
            [['account_location', 'telephone', 'company_contact_phone'], 'string', 'max' => 20],
            [['contact_address', 'company_address'], 'string', 'max' => 100],
            [['contact_postcode', 'company_postcode'], 'string', 'max' => 10],
            [['company_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户id',
            'name' => '姓名',
            'sex' => '性别',
            'birthday' => '生日',
            'credentials_type' => '证件类型',
            'credentials_number' => '证件号码',
            'account_location' => '户口所在地',
            'telephone' => '联系电话',
            'height' => '身高',
            'weight' => '体重',
            'disease_history' => '伤病史',
            'contact_address' => '联系地址',
            'contact_postcode' => '联系邮编',
            'company_name' => '公司名称',
            'company_address' => '公司地址',
            'company_postcode' => '公司邮编',
            'company_contact_phone' => '公司联系电话',
            'clothes_size' => '训练服尺码',
            't_shirt_size' => '训练T恤尺码',
            'shorts_size' => '球鞋尺码',
            'language' => '外语',
            'spoken_language' => '说能力',
            'write_language' => '写能力',
            'photo' => '照片',
            'credentials_photo' => '证书照片',
        ];
    }

    public function getUsersLevels()
    {
        return $this->hasMany(UsersLevel::className(), ['user_id' => 'id']);
    }


    /*
     * get sex name
    */
    public static function getSexName($sex)
    {
        return isset(self::$sexList[$sex]) ? self::$sexList[$sex] : $sex;
    }

    public static  function getCredentialsName($credentialsType)
    {
        return isset(self::$credentialsType[$credentialsType]) ? self::$credentialsType[$credentialsType] : $credentialsType;
    }

    public static  function getDiseaseHistoryName($diseaseHistory)
    {
        return isset(self::$diseaseHistory[$diseaseHistory]) ? self::$diseaseHistory[$diseaseHistory] : $diseaseHistory;
    }

    public static  function getSizeName($size)
    {
        return isset(self::$sizeList[$size]) ? self::$sizeList[$size] : $size;
    }

    public static  function getLanguageName($language)
    {
        return isset(self::$languageList[$language]) ? self::$languageList[$language] : $language;
    }

    public static  function getAbilityName($ability)
    {
        return isset(self::$abilityList[$ability]) ? self::$abilityList[$ability] : $ability;
    }


    public static function getCredentialsNumberByUserId($userId)
    {
        $sql = "SELECT credentials_number FROM " . self::tableName() . " WHERE user_id='" . $userId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryScalar();
        return $result;
    }

    public static function getPhotoByUserId($userId)
    {
        $sql = "SELECT photo FROM " . self::tableName() . " WHERE user_id='" . $userId . "'";
        $result = Yii::$app->db->createCommand($sql)->queryScalar();
        return $result;
    }

}
