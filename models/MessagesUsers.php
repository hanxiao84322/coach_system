<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "messages_users".
 *
 * @property integer $id
 * @property integer $messages_id
 * @property integer $users_id
 * @property integer $status
 * @property integer $type
 * @property integer $create_time
 * @property integer $content
 * @property integer $create_user
 * @property integer $update_time
 * @property integer $update_user
 */
class MessagesUsers extends \yii\db\ActiveRecord
{
    const UNREAD = 0;
    const READ = 1;

    public static $statusList = [
        self::UNREAD => '未读',
        self::READ => '已读',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['content'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'messages_id' => '模板',
            'users_id' => '用户',
            'status' => '状态',
            'type' => '类型',
            'content' => '内容',
        ];
    }

    public static function getMessagesByTypeUserId($users_id, $type)
    {
        $countSql = "SELECT count(mu.id) as count FROM " . self::tableName() . " mu LEFT JOIN " . Messages::tableName() . " m ON mu.messages_id = m.id WHERE mu.users_id=:users_id AND mu.type=:type";
        $sql = "SELECT mu.id,m.title,m.create_time,m.create_user,m.type,mu.users_id,mu.status,m.content FROM " . self::tableName() . " mu LEFT JOIN " . Messages::tableName() . " m ON mu.messages_id = m.id WHERE mu.users_id=:users_id AND mu.type=:type";

        $count = Yii::$app->db->createCommand($countSql, [':users_id' => $users_id, ':type' => $type])->queryScalar();

        $pages = new Pagination([
            'totalCount'=>$count,
            'pageSize' => '20'
        ]);
        $models = Yii::$app->db->createCommand($sql." limit ".$pages->limit." offset ".$pages->offset."",[':users_id' => $users_id, ':type' => $type])->queryAll();

        return ['models' => $models,'pages' => $pages];
    }

    public static function getCountByUserIdAndType($user_id, $type = '')
    {
        $countSql = "SELECT count(id) as count FROM " . self::tableName() . " WHERE users_id=:users_id AND status=" . MessagesUsers::UNREAD;
        if (!empty($type)) {
            if ($type != 1) {
                $countSql.= " AND type!=1";

            } else {
                $countSql.= " AND type=" . $type . " ";
            }
        }
        $count = Yii::$app->db->createCommand($countSql, [':users_id' => $user_id])->queryScalar();
        return $count;

    }

    public static function getSystemMessages($users_id)
    {
        $countSql = "SELECT count(id) as count FROM " . self::tableName() . " WHERE users_id=:users_id AND type!=1";
        $sql = "SELECT * FROM " . self::tableName() . " WHERE users_id=:users_id AND type!=1 order by id desc";

        $count = Yii::$app->db->createCommand($countSql, [':users_id' => $users_id])->queryScalar();

        $pages = new Pagination([
            'totalCount'=>$count,
            'pageSize' => '20'
        ]);
        $models = Yii::$app->db->createCommand($sql." limit ".$pages->limit." offset ".$pages->offset."",[':users_id' => $users_id])->queryAll();

        return ['models' => $models,'pages' => $pages];
    }

    public static function addInfo($data)
    {
        $sql = 'INSERT INTO ' . self::tableName() . ' (`messages_id`, `type`, `users_id`, `content`, `create_time`, `create_user`, `update_time`, `update_user`) VALUES ("' . $data['messages_id'] . '","' . $data['type'] . '","' . $data['users_id'] . '","' . $data['content'] . '","' . $data['create_time'] . '","' . $data['create_user'] . '","' . $data['update_time'] . '","' . $data['update_user'] . '")';
        return Yii::$app->db->createCommand($sql)->query();
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
