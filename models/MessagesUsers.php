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
 */
class MessagesUsers extends \yii\db\ActiveRecord
{
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
            [['messages_id', 'users_id', 'status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'messages_id' => 'Messages ID',
            'users_id' => 'Users ID',
            'status' => 'Status',
        ];
    }

    public static function getMessagesByTypeUserId($users_id, $type)
    {
        $countSql = "SELECT count(mu.id) as count FROM " . self::tableName() . " mu LEFT JOIN " . Messages::tableName() . " m ON mu.messages_id = m.id WHERE mu.users_id=:users_id AND m.type=:type";
        $sql = "SELECT mu.id,m.title,m.create_time,m.create_user,m.type,mu.users_id,mu.status,m.content FROM " . self::tableName() . " mu LEFT JOIN " . Messages::tableName() . " m ON mu.messages_id = m.id WHERE mu.users_id=:users_id AND m.type=:type";


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
        $countSql = "SELECT count(mu.id) as count FROM " . self::tableName() . " mu LEFT JOIN " . Messages::tableName() . " m ON mu.messages_id=m.id WHERE mu.users_id=:users_id AND mu.status=0";
        if (!empty($type)) {
            $countSql.= " AND m.type=" . $type . " ";
        }
        $count = Yii::$app->db->createCommand($countSql, [':users_id' => $user_id])->queryScalar();
        return $count;

    }
}
