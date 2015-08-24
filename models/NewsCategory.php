<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%news_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property News[] $news
 */
class NewsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'safe'],
            [['name', 'create_user', 'update_user'], 'string', 'max' => 45]
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
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '修改时间',
            'update_user' => '修改人',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['category_id' => 'id']);
    }

    public function getAll()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'name'])
            ->from(self::tableName())
            ->all();
        return $rows;
    }

    public function getOneCategoryNameById($categoryId)
    {
        $row = (new \yii\db\Query())
            ->select(['name'])
            ->from(self::tableName())
            ->where('id=:id', [':id'=>$categoryId])
            ->one();
        return $row['name'];
    }

    /*
 * get sex name
 */
    public function getIsRecommendName($isRecommend)
    {
        return ($isRecommend == 1) ? '是' : '否';
    }

    public function beforeSave()
    {
        if (parent::beforeSave(true)) {
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
