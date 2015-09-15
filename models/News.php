<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $status
 * @property string $thumb
 * @property integer $is_pic
 * @property integer $is_recommend
 * @property string $tag
 * @property string $related_news
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property NewsCategory $category
 * @property Users $user
 */
class News extends \yii\db\ActiveRecord
{

    //状态
    const NEW_ADD = 0; // 待审核
    const APPROVED = 1; // 已审核

    static public $statusList = [
        self::NEW_ADD => '已审核',
        self::APPROVED => '进行中'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'status', 'is_recommend'], 'integer'],
            [['title', 'content'], 'required'],
            [['thumb'], 'file', 'extensions' => 'png, jpg, gif'],
            [['title', 'create_user', 'update_user'], 'string', 'max' => 45],
            [['tag'], 'string', 'max' => 50],
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
            'user_id' => '相关教练',
            'category_id' => '分类',
            'status' => '状态',
            'thumb' => '缩略图',
            'is_pic' => '是否有图片',
            'is_recommend' => '是否首页推荐',
            'tag' => '标签',
            'related_news' => '相关新闻',
            'create_time' => '创建时间',
            'create_user' => '创建人',
            'update_time' => '更新时间',
            'update_user' => '更新人',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public static  function getStatusName($status)
    {
        return isset(self::$statusList[$status]) ? self::$statusList[$status] : $status;
    }

    public static function getIndexNewsByCategory($categoryId, $count)
    {
        $sql = "SELECT * FROM `news` WHERE category_id = '" . $categoryId . "' AND is_recommend = 1 ORDER BY id desc LIMIT 0," . $count;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function getAboutNewsByCategory($categoryId)
    {
        $sql = "SELECT * FROM `news` WHERE category_id = '" . $categoryId . "'  ORDER BY id desc LIMIT 0,5";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function getImgRecommendNewsByCategory($categoryId, $count)
    {
        $sql = "SELECT * FROM `news` WHERE category_id = '" . $categoryId . "' AND is_recommend = 1 AND thumb != '' ORDER BY id desc LIMIT 0," . $count;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    /**
     * @param $levelId
     * @param $count
     *
     * @return array
     */
    public static function getTrainWindByLevelId($levelId, $count)
    {
        $sql = "SELECT n.* FROM `news` n LEFT JOIN `users` u on n.user_id = u.id WHERE u.level_id = '" . $levelId . "' AND is_recommend = 1 AND thumb != '' ORDER BY n.id desc LIMIT 0," . $count;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;

    }

    public static function getNewsByUserId($userId, $count)
    {
        $sql = "SELECT * FROM `news` WHERE user_id = '" . $userId . "' AND  thumb != '' ORDER BY id desc LIMIT 0," . $count;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    public static function getNewsByCategory($categoryId, $count)
    {
        $sql = "SELECT * FROM `news` WHERE category_id = '" . $categoryId . "'  ORDER BY id desc LIMIT 0," . $count;
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
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
