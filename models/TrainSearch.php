<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Train;

/**
 * TrainSearch represents the model behind the search form about `app\models\Train`.
 */
class TrainSearch extends Train
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', 'level_id', 'recruit_count', 'sign_up_status', 'status', 'lesson','period_num'], 'integer'],
            [['name', 'sign_up_begin_time', 'sign_up_end_time', 'begin_time', 'end_time', 'address', 'content', 'create_time', 'create_user', 'update_time', 'update_user','begin_date','end_date'], 'safe'],
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
        $query = Train::find();

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
            'category' => $this->category,
            'level_id' => $this->level_id,
            'recruit_count' => $this->recruit_count,
            'status' => $this->status,
            'period_num' => $this->period_num,
            'lesson' => $this->lesson,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        if (!empty($this->begin_date) && !empty($this->end_date)) {
            $query->andFilterWhere(['>', 'begin_time', $this->begin_date])
            ->andFilterWhere(['<', 'begin_time', $this->end_date]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'create_user', $this->create_user])
            ->andFilterWhere(['like', 'update_user', $this->update_user]);
        $query->orderBy('id desc');
        return $dataProvider;
    }
}
