<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $product
 * @property integer $user_id
 * @property string $price
 * @property integer $status
 * @property integer $type
 * @property integer $level_id
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'type', 'level_id'], 'integer'],
            [['price'], 'number'],
            [['status'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['product'], 'string', 'max' => 200],
            [['create_user', 'update_user'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product' => '产品',
            'user_id' => '用户',
            'price' => '价格',
            'status' => '状态',
            'type' => '类型',
            'level_id' => '级别',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }
}
