<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsersPlayers;

/**
 * UsersPlayersSearch represents the model behind the search form about `app\models\UsersPlayers`.
 */
class UsersPlayersSearch extends UsersPlayers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['team', 'begin_time', 'end_time', 'address', 'witness', 'witness_phone', 'description', 'create_time', 'update_time', 'update_user', 'level'], 'safe'],
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
        $query = UsersPlayers::find();

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
            'user_id' => $this->user_id,
            'begin_time' => $this->begin_time,
            'end_time' => $this->end_time,
            'level' => $this->level,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'team', $this->team])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'witness', $this->witness])
            ->andFilterWhere(['like', 'witness_phone', $this->witness_phone])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'update_user', $this->update_user]);

        return $dataProvider;
    }
}
