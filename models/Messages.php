<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $type
 * @property integer $status
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 */
class Messages extends \yii\db\ActiveRecord
{

    const COMMENT = 1;
    const SYSTEM_COMMENT = 2;
    const REGISTER_SUCCESS = 3;
    const REGISTER_ERROR = 4;
    const TRAIN_SIGN_SUCCESS = 5;
    const TRAIN_PASS = 6;
    const TRAIN_NO_PASS = 7;
    const TRAIN_SIGN_ERROR = 8;
    const ACTIVITY_SIGN_SUCCESS = 9;
    const SIGN = 10;
    const TRAIN_DOING = 11;
    const TRAIN_END = 12;

    public static $typeList = [
        self::COMMENT => '最新公告',
        self::SYSTEM_COMMENT => '系统通知',
        self::REGISTER_SUCCESS => '教练员注册成功提示',
        self::REGISTER_ERROR => '教练员注册失败提示',
        self::TRAIN_SIGN_SUCCESS => '培训报名成功提示',
        self::TRAIN_SIGN_ERROR => '培训审核未通过提示',
        self::TRAIN_PASS => '培训通过提示',
        self::TRAIN_NO_PASS => '培训未通过提示',
        self::ACTIVITY_SIGN_SUCCESS => '活动通过提示',
        self::SIGN => '注册申请',
        self::TRAIN_DOING => '培训开始提示',
        self::TRAIN_END => '培训结束提示',
    ];

    const ENABLE = 1;
    const DISABLE = 0;

    public static $statusList = [
        self::ENABLE => '启用',
        self::DISABLE => '未启用',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type','status'], 'integer'],
            [['content','title'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['title', 'create_user', 'update_user'], 'string', 'max' => 45],
            [['content'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'type' => '类型',
            'status' => '状态',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    public static function addInfo($data)
    {
        return Yii::$app->db->createCommand()->insert(self::tableName(),$data);

    }

    public static function getAll()
    {
        $sql = "SELECT * FROM " . self::tableName() . " WHERE status = 1 order by id asc ";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        return $data;
    }

    public static function getContent($id)
    {
        $sql = "SELECT content FROM " . self::tableName() . " WHERE id=:id ";
        $content = Yii::$app->db->createCommand($sql, [':id' => $id])->queryScalar();
        return $content;

    }

    public static function getContentByType($type)
    {
        $sql = "SELECT content FROM " . self::tableName() . " WHERE type=:type AND status = 1 order by id desc  limit 0,1 ";
        $content = Yii::$app->db->createCommand($sql, [':type' => $type])->queryScalar();
        return $content;

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
