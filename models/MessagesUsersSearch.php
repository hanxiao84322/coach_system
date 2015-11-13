<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MessagesUsers;

/**
 * MessagesUsersSearch represents the model behind the search form about `app\models\MessagesUsers`.
 */
class MessagesUsersSearch extends MessagesUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'messages_id', 'users_id', 'status', 'type'], 'integer'],
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
        $query = MessagesUsers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if ($this->type == 2) {
            $query->andWhere('type > 1');

        } else {
            $query->andWhere('type = 1');

        }
        $query->andFilterWhere([
            'id' => $this->id,
            'messages_id' => $this->messages_id,
            'users_id' => $this->users_id,
            'status' => $this->status,
        ]);
        $query->orderBy('id desc');

        return $dataProvider;
    }
}
