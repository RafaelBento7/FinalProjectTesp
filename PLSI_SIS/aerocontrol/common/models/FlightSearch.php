<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Flight;

/**
 * FlightSearch represents the model behind the search form of `common\models\Flight`.
 */
class FlightSearch extends Flight
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'discount_percentage', 'origin_airport_id', 'arrival_airport_id', 'airplane_id'], 'integer'],
            [['terminal', 'estimated_departure_date', 'estimated_arrival_date', 'departure_date', 'arrival_date', 'state'], 'safe'],
            [['price', 'distance'], 'number'],
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
        $query = Flight::find();


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'estimated_departure_date' => $this->estimated_departure_date,
            'estimated_arrival_date' => $this->estimated_arrival_date,
            'departure_date' => $this->departure_date,
            'arrival_date' => $this->arrival_date,
            'price' => $this->price,
            'distance' => $this->distance,
            'discount_percentage' => $this->discount_percentage,
            'origin_airport_id' => $this->origin_airport_id,
            'arrival_airport_id' => $this->arrival_airport_id,
            'airplane_id' => $this->airplane_id,
        ]);

        $query->andFilterWhere(['like', 'terminal', $this->terminal])
            ->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
}
