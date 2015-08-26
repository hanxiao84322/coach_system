<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configuration".
 *
 * @property integer $id
 * @property string $web_name
 * @property string $contact_email
 * @property integer $attach_size
 * @property string $keyword
 * @property string $description
 * @property string $copyright
 * @property string $address
 * @property string $contact_phone
 * @property string $icp
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 */
class Configuration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attach_size'], 'integer'],
            [['icp'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['web_name', 'copyright', 'contact_phone', 'icp', 'create_user', 'update_user'], 'string', 'max' => 45],
            [['contact_email', 'address'], 'string', 'max' => 100],
            [['keyword', 'description'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'web_name' => '网站名称',
            'contact_email' => '联系邮箱',
            'attach_size' => '附件大小',
            'keyword' => '关键字',
            'description' => '描述',
            'copyright' => '版权信息',
            'address' => '公司地址',
            'contact_phone' => '联系电话',
            'icp' => '备案信息',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }
}
