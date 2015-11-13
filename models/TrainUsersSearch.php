<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TrainUsers;

/**
 * TrainUsersSearch represents the model behind the search form about `app\models\TrainUsers`.
 */
class TrainUsersSearch extends TrainUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'train_id', 'user_id', 'status', 'practice_score', 'theory_score', 'rule_score'], 'integer'],
            [['score_appraise', 'attendance_appraise', 'practice_comment', 'theory_comment', 'rule_comment', 'total_comment', 'result_comment', 'create_time', 'create_user', 'update_time', 'update_user'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TrainUsers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'train_id' => $this->train_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'practice_score' => $this->practice_score,
            'theory_score' => $this->theory_score,
            'rule_score' => $this->rule_score,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,

        ]);

        $query->andFilterWhere(['like', 'score_appraise', $this->score_appraise])
            ->andFilterWhere(['like', 'attendance_appraise', $this->attendance_appraise])
            ->andFilterWhere(['like', 'practice_comment', $this->practice_comment])
            ->andFilterWhere(['like', 'theory_comment', $this->theory_comment])
            ->andFilterWhere(['like', 'rule_comment', $this->rule_comment])
            ->andFilterWhere(['like', 'total_comment', $this->total_comment])
            ->andFilterWhere(['like', 'result_comment', $this->result_comment])
            ->andFilterWhere(['like', 'create_user', $this->create_user])
            ->andFilterWhere(['like', 'update_user', $this->update_user])
            ->andFilterWhere(['<>', 'status', TrainUsers::CANCEL]);
        $query->orderBy(' id desc ');

        return $dataProvider;
    }
}
