<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Activity;

/**
 * ActivitySearch represents the model behind the search form about `app\models\Activity`.
 */
class ActivitySearch extends Activity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', 'level_id', 'recruit_count', 'sign_up_status', 'status', 'lesson', 'score'], 'integer'],
            [['name', 'sign_up_begin_time', 'sign_up_end_time', 'begin_time', 'end_time', 'content', 'address', 'launch', 'organizers', 'join_teams', 'create_time', 'create_user', 'update_time', 'update_user'], 'safe'],
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
        $query = Activity::find();

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
            'sign_up_begin_time' => $this->sign_up_begin_time,
            'sign_up_end_time' => $this->sign_up_end_time,
            'sign_up_status' => $this->sign_up_status,
            'begin_time' => $this->begin_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
            'lesson' => $this->lesson,
            'score' => $this->score,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'launch', $this->launch])
            ->andFilterWhere(['like', 'organizers', $this->organizers])
            ->andFilterWhere(['like', 'join_teams', $this->join_teams])
            ->andFilterWhere(['like', 'create_user', $this->create_user])
            ->andFilterWhere(['like', 'update_user', $this->update_user]);

        return $dataProvider;
    }
}
