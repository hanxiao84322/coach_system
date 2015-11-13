<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "train_land".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $contacts
 * @property string $contact_phone
 * @property string $site_type
 * @property string $district
 * @property string $thumb
 * @property string $bus
 * @property string $site
 * @property string $content
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 */
class TrainLand extends \yii\db\ActiveRecord
{

    const NATURAL = 1;
    const ARTIFICIAL = 2;
    const EARTH = 3;
    const OTHER = 4;

    public static $typeList = [
        self::NATURAL => '天然草场',
        self::ARTIFICIAL => '人造草场',
        self::EARTH => '土场',
        self::OTHER => '其它',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'train_land';
    }

    static public $districtList = [
        '1' => '东城区',
        '2' => '西城区',
        '3' => '朝阳区',
        '4' => '丰台区',
        '5' => '石景山区',
        '6' => '海淀区',
        '7' => '门头沟区',
        '8' => '房山区',
        '9' => '通州区',
        '10' => '顺义区',
        '11' => '昌平区',
        '12' => '大兴区',
        '13' => '怀柔区',
        '14' => '平谷区',
        '15' => '密云县',
        '16' => '延庆县',
        '17' => '其他区',
    ];
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_type','district'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['thumb'], 'file', 'extensions' => 'png, jpg, gif'],
            [['name', 'contacts', 'contact_phone', 'bus', 'site', 'create_user', 'update_user'], 'string', 'max' => 45],
            [['address', 'content','thumb'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'address' => '地址',
            'contacts' => '联系人',
            'contact_phone' => '联系电话',
            'site_type' => '场地类型',
            'district' => '所在区域',
            'thumb' => '缩略图',
            'bus' => '公交路线',
            'site' => '周边站点',
            'content' => '提示',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }


    public static function getAll()
    {
        $result = [];
        $rows = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from(self::tableName())
            ->all();
        if (!empty($rows)) {
            foreach ($rows as $key => $val) {
                $result[$val['id']] = $val['name'];
            }
        }

        return $result;
    }
    public static function getNameById($id)
    {
        $sql = "SELECT name FROM " . self::tableName() . " WHERE id=" . $id;
        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    public static function getCountList()
    {
        $sql = "SELECT site_type FROM " . self::tableName() . " GROUP BY site_type";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static function getAllCountBySiteType($siteType = '')
    {
        if (!empty($siteType)) {
            $sql = "SELECT count(*) as count FROM " . self::tableName() . " WHERE site_type = " . $siteType;
        } else {
            $sql = "SELECT count(*) as count FROM " . self::tableName();
        }
        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    public static function getAllCountByDistrict($district = '')
    {
        $sql = "SELECT count(*) as count FROM " . self::tableName() . " WHERE district = " . $district;
        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    public static function getAllData()
    {
        $sql = "SELECT * FROM " . self::tableName();
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public static function getAllDataByCount($count = 10)
    {
        $sql = "SELECT * FROM " . self::tableName() . " LIMIT 0," . $count;
        return Yii::$app->db->createCommand($sql)->queryAll();
    }


    public function beforeSave($insert = '')
    {
        if (parent::beforeSave($this->isNewRecord)) {
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
