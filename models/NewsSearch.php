<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\News;

/**
 * NewsSearch represents the model behind the search form about `app\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id', 'status', 'is_pic', 'is_recommend'], 'integer'],
            [['title', 'content', 'thumb', 'tag', 'related_news', 'create_time', 'create_user', 'update_time', 'update_user'], 'safe'],
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
        $query = News::find();

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
            'category_id' => $this->category_id,
            'status' => $this->status,
            'is_pic' => $this->is_pic,
            'is_recommend' => $this->is_recommend,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'thumb', $this->thumb])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'related_news', $this->related_news])
            ->andFilterWhere(['like', 'create_user', $this->create_user])
            ->andFilterWhere(['like', 'update_user', $this->update_user]);

        return $dataProvider;
    }
}
