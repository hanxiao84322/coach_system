<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity_users".
 *
 * @property integer $id
 * @property integer $activity_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $practice_score
 * @property integer $theory_score
 * @property integer $rule_score
 * @property string $score_appraise
 * @property string $attendance_appraise
 * @property string $practice_comment
 * @property string $theory_comment
 * @property string $rule_comment
 * @property string $total_comment
 * @property string $result_comment
 * @property string $create_time
 * @property string $create_user
 * @property string $update_time
 * @property string $update_user
 *
 * @property Activity $activity
 * @property Users $user
 */
class ActivityUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'user_id', 'status', 'practice_score', 'theory_score', 'rule_score'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['score_appraise', 'attendance_appraise', 'practice_comment', 'theory_comment', 'rule_comment', 'total_comment', 'result_comment', 'create_user', 'update_user'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'practice_score' => 'Practice Score',
            'theory_score' => 'Theory Score',
            'rule_score' => 'Rule Score',
            'score_appraise' => 'Score Appraise',
            'attendance_appraise' => 'Attendance Appraise',
            'practice_comment' => 'Practice Comment',
            'theory_comment' => 'Theory Comment',
            'rule_comment' => 'Rule Comment',
            'total_comment' => 'Total Comment',
            'result_comment' => 'Result Comment',
            'create_time' => 'Create Time',
            'create_user' => 'Create User',
            'update_time' => 'Update Time',
            'update_user' => 'Update User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activity::className(), ['id' => 'activity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public static function getAllActivityByUserId($userId = '', $isPage = true)
    {
        $count = Yii::$app->db->createCommand('SELECT (au.id) as count FROM  ' . self::tableName() . ' au LEFT JOIN ' . Activity::tableName() . ' a ON au.activity_id = a.id WHERE au.user_id=:user_id', [':user_id' => $userId])->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT au.id as id,au.train_id,a.name,a.category,a.create_time,a.address,a.recruit_count,au.status,a.begin_time FROM  ' . self::tableName() . ' au LEFT JOIN ' . Activity::tableName() . ' a ON au.activity_id = a.id WHERE au.user_id=:user_id',
            'params' => [':user_id' => $userId],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => $isPage ? '5' : '9999',
            ],
        ]);
        $models = $dataProvider->getModels();
        return $models;

    }
}
