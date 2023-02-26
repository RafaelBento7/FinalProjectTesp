<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FlightTicket;

/**
 * FlightTicketSearch represents the model behind the search form of `common\models\FlightTicket`.
 */
class FlightTicketSearch extends FlightTicket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['flight_ticket_id', 'checkin', 'client_id', 'flight_id', 'payment_method_id'], 'integer'],
            [['price'], 'number'],
            [['purchase_date'], 'safe'],
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
        $query = FlightTicket::find();

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
            'flight_ticket_id' => $this->flight_ticket_id,
            'price' => $this->price,
            'purchase_date' => $this->purchase_date,
            'checkin' => $this->checkin,
            'client_id' => $this->client_id,
            'flight_id' => $this->flight_id,
            'payment_method_id' => $this->payment_method_id,
        ]);

        return $dataProvider;
    }
}
