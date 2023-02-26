<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class FlightForm extends Model
{
    public const FLIGHT_TYPE_GO = "FLIGHT_GO";
    public const FLIGHT_TYPE_BACK = "FLIGHT_TYPE_BACK";

    public $origin;
    public $destiny;
    public $origin_departure_date;
    public $destiny_departure_date;
    public $passengers;
    public $two_way_trip;

    public $customErrorMessage;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['passengers', 'required', 'message' => "{attribute} não pode ser vazio."],
            [['origin', 'destiny'], 'required', 'message' => "O aeroporto de {attribute} não pode ser vazio."],
            [['origin', 'destiny'], 'string', 'max' => 75, 'message' => '{attribute} não pode exceder os 75 caracteres.'],
            [
                ['origin_departure_date', 'destiny_departure_date'],
                'date', 'message' => "{attribute} tem o formato errado.",
                'format' => 'yyyy-MM-dd'
            ],
            [
                'passengers', 'number', 'message' => '{attribute} tem que ser um número.',
                'min' => 1, 'tooSmall' => 'O {attribute} não pode ser inferior a 1.'
            ],
            ['destiny', 'compare', 'operator' => '!=', 'compareAttribute' => 'origin', 'message' => 'O aeroporto de {attribute} não pode ser igual ao aeroporto de {compareAttribute}.'],
            ['two_way_trip', 'boolean'],
        ];
    }

    public function beforeValidate()
    {
        $arrivalAirport = Airport::findOne(["name" => $this->destiny]);
        $originAirport = Airport::findOne(["name" => $this->origin]);

        if (!isset($originAirport))
            $this->addError('origin', "Selecione um dos aeroportos disponíveis.");


        if (!isset($arrivalAirport))
            $this->addError('destiny', "Selecione um dos aeroportos disponíveis.");

        if ($this->hasErrors()) return false;

        return parent::beforeValidate();
    }

    public function attributeLabels()
    {
        return [
            'origin' => 'Origem',
            'destiny' => 'Destino',
            'origin_departure_date' => 'Data de partida',
            'destiny_departure_date' => 'Data de volta',
            'passengers' => 'Nº Passageiros',
            'two_way_trip' => 'Ida/Ida e Volta',
        ];
    }

    /**
     * Dá return a um data provider com todos os voos de Ida
     * @param bool|null $tryAgain se true, significa que o utilizador premiu o botão de ver mais resultados em datas não especificas
     * @return ActiveDataProvider
     */
    public function getDataProviderGo(bool $tryAgain = null)
    {
        $arrivalAirport = Airport::findOne(["name" => $this->destiny]);
        $originAirport = Airport::findOne(["name" => $this->origin]);

        $query = Flight::find()->where([
            'origin_airport_id' => $originAirport->id,
            'arrival_airport_id' => $arrivalAirport->id
        ])
            ->andWhere(['>=', 'passengers_left', $this->passengers]);

        // Se o utilizador escrever data faz a query com a data
        if ($this->origin_departure_date != null) {
            if ($tryAgain) {     // Procura datas, para além das indicadas (quando clica no procurar mais datas)
                $query->andWhere([
                    '>', 'estimated_departure_date', $this->origin_departure_date . " 00:00",
                ]);
            } else {
                $query->andWhere([
                    '>', 'estimated_departure_date', $this->origin_departure_date . " 00:00",
                ])->andWhere([
                    '<', 'estimated_departure_date', $this->origin_departure_date . " 23:59",
                ]);
            }
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    /**
     * Dá return a um data provider com todos os voos de Volta
     * @param bool|null $tryAgain se true, significa que o utilizador premiu o botão de ver mais resultados em datas não especificas
     * @return ActiveDataProvider
     */
    public function getDataProviderBack(bool $tryAgain = null)
    {
        $arrivalAirport = Airport::findOne(["name" => $this->destiny]);
        $originAirport = Airport::findOne(["name" => $this->origin]);

        $query = Flight::find()->where([
            'origin_airport_id' => $arrivalAirport->id,
            'arrival_airport_id' => $originAirport->id
        ])
            ->andWhere(['>=', 'passengers_left', $this->passengers]);

        // Se o utilizador escrever data faz a query com a data
        if ($this->destiny_departure_date != null) {
            if ($tryAgain) {     // Procura datas, para além das indicadas (quando clica no procurar mais datas)
                $query->andWhere([
                    '>', 'estimated_departure_date', $this->destiny_departure_date . " 00:00",
                ]);
            } else {
                $query->andWhere([
                    '>', 'estimated_departure_date', $this->destiny_departure_date . " 00:00",
                ])->andWhere([
                    '<', 'estimated_departure_date', $this->destiny_departure_date . " 23:59",
                ]);
            }
        }

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function loadDefaultValues()
    {
        $this->two_way_trip = 0;
    }
}
