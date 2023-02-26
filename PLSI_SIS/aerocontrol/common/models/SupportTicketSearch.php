<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SupportTicketSearch represents the model behind the search form of `common\models\SupportTicket`.
 */
class SupportTicketSearch extends SupportTicket
{

    public $client_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id'], 'integer'],
            [['title', 'state'], 'safe'],
            [['client_name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = SupportTicket::find();

        $query->joinWith(['client.user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['client_name'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'client_id' => $this->client_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'user.username', $this->client_name]);

        return $dataProvider;
    }
}
