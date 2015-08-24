<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Level;

/**
 * LevelSearch represents the model behind the search form about `app\models\Level`.
 */
class LevelSearch extends Level
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lesson', 'credit', 'score', 'login_duration'], 'integer'],
            [['name', 'content', 'create_time', 'update_time', 'update_user'], 'safe'],
            [['register_fee'], 'number'],
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
        $query = Level::find();

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
            'lesson' => $this->lesson,
            'credit' => $this->credit,
            'score' => $this->score,
            'login_duration' => $this->login_duration,
            'register_fee' => $this->register_fee,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'update_user', $this->update_user]);

        return $dataProvider;
    }
}
