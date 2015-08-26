<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_group".
 *
 * @property integer $id
 * @property string $group_name
 * @property string $model
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property Admin[] $admins
 */
class AdminGroup extends \yii\db\ActiveRecord
{

    const USERS = 'users';
    const LEVEL = 'level';
    const TRAIN = 'train';
    const ACTIVITY = 'activity';
    const PAGES = 'pages';
    const NEWS = 'news';
    const NEWS_CATEGORY = 'news_category';
    const CONFIGURATION = 'configuration';

    public static $modelsList = [
        self::USERS => '用户管理',
        self::LEVEL => '级别管理管理',
        self::TRAIN => '培训管理',
        self::ACTIVITY => '活动管理',
        self::PAGES => '内容管理',
        self::NEWS => '新闻管理',
        self::NEWS_CATEGORY => '新闻分类管理',
        self::CONFIGURATION => '配置管理',
    ];

    public $modelList = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['group_name', 'create_user', 'update_user'], 'string', 'max' => 45],
            [['model'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_name' => '权限组名称',
            'model' => '模块',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['group_id' => 'id']);
    }

    public static function getAll()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'group_name'])
            ->from(self::tableName())
            ->all();
        return $rows;
    }

    public static function getOneAdminGroupNameById($groupId)
    {
        $row = (new \yii\db\Query())
            ->select(['group_name'])
            ->from(self::tableName())
            ->where('id=:id', [':id'=>$groupId])
            ->one();
        return $row['group_name'];
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
