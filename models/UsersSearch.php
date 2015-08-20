<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sex', 'title', 'status', 'credentials_type', 'height', 'weight', 'disease_history', 'clothes_size', 't_shirt_size', 'shorts_size', 'language', 'spoken_language', 'write_language', 'lesson', 'credit', 'score'], 'integer'],
            [['name', 'password', 'birthday', 'credentials_number', 'account_location', 'telephone', 'mobile_phone', 'email', 'contact_address', 'contact_postcode', 'company_name', 'company_address', 'company_postcode', 'company_contact_phone', 'create_time', 'update_time', 'update_user'], 'safe'],
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
        $query = Users::find();

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
            'sex' => $this->sex,
            'birthday' => $this->birthday,
            'title' => $this->title,
            'status' => $this->status,
            'credentials_type' => $this->credentials_type,
            'height' => $this->height,
            'weight' => $this->weight,
            'disease_history' => $this->disease_history,
            'clothes_size' => $this->clothes_size,
            't_shirt_size' => $this->t_shirt_size,
            'shorts_size' => $this->shorts_size,
            'language' => $this->language,
            'spoken_language' => $this->spoken_language,
            'write_language' => $this->write_language,
            'lesson' => $this->lesson,
            'credit' => $this->credit,
            'score' => $this->score,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'credentials_number', $this->credentials_number])
            ->andFilterWhere(['like', 'account_location', $this->account_location])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'contact_address', $this->contact_address])
            ->andFilterWhere(['like', 'contact_postcode', $this->contact_postcode])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'company_address', $this->company_address])
            ->andFilterWhere(['like', 'company_postcode', $this->company_postcode])
            ->andFilterWhere(['like', 'company_contact_phone', $this->company_contact_phone])
            ->andFilterWhere(['like', 'update_user', $this->update_user]);

        return $dataProvider;
    }
}
