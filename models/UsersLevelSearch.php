<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsersLevel;

/**
 * UsersLevelSearch represents the model behind the search form about `app\models\UsersLevel`.
 */
class UsersLevelSearch extends UsersLevel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'level_id', 'is_pay'], 'integer'],
            [['certificate_number', 'district', 'receive_address', 'postcode', 'create_time', 'update_time', 'update_user'], 'safe'],
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
        $query = UsersLevel::find();

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
            'level_id' => $this->level_id,
            'is_pay' => $this->is_pay,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'certificate_number', $this->certificate_number])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'receive_address', $this->receive_address])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'update_user', $this->update_user]);
        $query->orderBy(' id desc ');
        return $dataProvider;
    }
}
