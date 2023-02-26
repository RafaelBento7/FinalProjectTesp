<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "flight".
 *
 * @property int $id
 * @property string $terminal
 * @property string $estimated_departure_date
 * @property string $estimated_arrival_date
 * @property string|null $departure_date
 * @property string|null $arrival_date
 * @property float $price
 * @property float $distance
 * @property string $state
 * @property int $discount_percentage
 * @property int $origin_airport_id
 * @property int $arrival_airport_id
 * @property int $airplane_id
 * @property int $passengers_left
 *
 * @property Airplane $airplane
 * @property Airport $arrivalAirport
 * @property FlightTicket[] $flightTickets
 * @property Airport $originAirport
 */
class Flight extends \yii\db\ActiveRecord
{
    const SCENARIO_ON_UPDATE = 'on_udpate';

    const POSSIBLE_STATES = [
        'Previsto',
        'Chegou',
        'Partiu',
        'Cancelado',
        'Embarque',
        'Última Chamada'
    ];

    const POSSIBLE_STATES_FOR_DROPDOWN = [
        'Previsto' => 'Previsto',
        'Chegou' => 'Chegou',
        'Partiu' => 'Partiu',
        'Cancelado' => 'Cancelado',
        'Embarque' => 'Embarque',
        'Última Chamada' => 'Última Chamada'
    ];

    private $possible_flight_airports;
    public $possible_flight_airports_for_dropdown;

    private $possible_flight_airplanes;
    public $possible_flight_airplanes_for_dropdown;


    public function __construct($config = [])
    {
        // Setups the possible values for flight airport
        $this->setupPossibleFlightAirports();

        // Setups the possible values for flight airplane
        $this->setupPossibleFlightAirplanes();

        parent::__construct($config);
    }

    // Formatar as datas visualmente se encontrar um registo
    public function afterFind()
    {
        $this->estimated_departure_date = Yii::$app->formatter->asDatetime($this->estimated_departure_date);
        $this->estimated_arrival_date = Yii::$app->formatter->asDatetime($this->estimated_arrival_date);
        $this->departure_date = Yii::$app->formatter->asDatetime($this->departure_date);
        $this->arrival_date = Yii::$app->formatter->asDatetime($this->arrival_date);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%flight}}';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ON_UPDATE] = [
            'terminal', 'estimated_departure_date', 'estimated_arrival_date',
            'price', 'distance', 'state', 'discount_percentage', 'origin_airport_id',
            'arrival_airport_id', 'airplane_id',
            'departure_date', 'arrival_date'
        ];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['terminal', 'estimated_departure_date', 'estimated_arrival_date', 'departure_date', 'arrival_date', 'price', 'distance', 'state', 'discount_percentage', 'origin_airport_id', 'arrival_airport_id', 'airplane_id'], 'trim'],
            [['departure_date', 'arrival_date'], 'default', 'value' => null],
            [['terminal', 'estimated_departure_date', 'estimated_arrival_date', 'price', 'distance', 'state', 'discount_percentage', 'origin_airport_id', 'arrival_airport_id', 'airplane_id'], 'required', 'message' => "{attribute} não pode ser vazio."],
            [['price', 'distance'], 'number', 'message' => '{attribute} tem que ser um número.'],

            ['terminal', 'string', 'max' => 3, 'message' => '{attribute} não pode exceder os 3 caracteres.'],

            [
                ['estimated_departure_date', 'estimated_arrival_date', 'departure_date', 'arrival_date'],
                'datetime', 'message' => "{attribute} tem o formato errado."
            ],

            ['estimated_arrival_date', 'compareEstimatedDepartureDate'],

            ['departure_date', 'compareEstimatedDepartureDate', 'on' => self::SCENARIO_ON_UPDATE],
            ['arrival_date', 'compareArrivalDate', 'on' => self::SCENARIO_ON_UPDATE],

            ['state', 'in', 'range' => self::POSSIBLE_STATES, 'strict' => true],

            ['state', 'default', 'value' => 'Previsto'],

            [['discount_percentage'], 'integer', 'message' => '{attribute} tem que ser um número inteiro.'],


            [
                'airplane_id', 'in',
                'range' => $this->possible_flight_airplanes,
                'message' => 'Avião inválido.'
            ],
            [
                ['arrival_airport_id', 'origin_airport_id'], 'in',
                'range' => $this->possible_flight_airports,
                'message' => 'Aeroporto inválido.'
            ],
            [
                'arrival_airport_id', 'compare',
                'compareAttribute' => 'origin_airport_id', 'operator' => '!=',
                'message' => 'O aeroporto de chegada têm de ser diferente do aeroporto de origem.'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'terminal' => 'Terminal',
            'estimated_departure_date' => 'Data de Partida Estimada',
            'estimated_arrival_date' => 'Data de Chegada Estimada',
            'departure_date' => 'Data de Partida',
            'arrival_date' => 'Data de Chegada',
            'price' => 'Preço',
            'distance' => 'Distância',
            'state' => 'Estado',
            'discount_percentage' => 'Desconto(%)',
            'origin_airport_id' => 'Aeroporto de Origem',
            'arrival_airport_id' => 'Aeroporto de Chegada',
            'airplane_id' => 'Avião',
            'passengers_left' => 'Nº Passageiros restantes'
        ];
    }

    /**
     * Compara a end date com a data de partida estimada
     */
    public function compareEstimatedDepartureDate($attribute, $params, $validator)
    {
        $start_date = strtotime($this->estimated_departure_date);
        $end_date = strtotime($this->$attribute);
        if ($end_date < $start_date)
            $validator->addError($this, $attribute, 'A {attribute} não pode ser antes da Data de Partida Estimada.');
    }

    /**
     * Compara a end date com a data de partida
     */
    public function compareArrivalDate($attribute, $params, $validator)
    {
        $start_date = strtotime($this->departure_date);
        $end_date = strtotime($this->$attribute);
        if ($end_date < $start_date)
            $validator->addError($this, $attribute, 'A {attribute} não pode ser antes da Data de Partida.');
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // Se for para criar um voo entao as datas certas são iguais às datas estimadas
        if ($insert) {
            $this->passengers_left = $this->airplane->capacity;
            $this->departure_date = $this->estimated_departure_date;
            $this->arrival_date = $this->estimated_arrival_date;
        }

        // Formatar as datas para a BD MySQL
        $this->estimated_departure_date = Yii::$app->formatter->asDatetime($this->estimated_departure_date, 'php:Y-m-d H:i');
        $this->estimated_arrival_date = Yii::$app->formatter->asDatetime($this->estimated_arrival_date, 'php:Y-m-d H:i');
        $this->departure_date = Yii::$app->formatter->asDatetime($this->departure_date, 'php:Y-m-d H:i');
        $this->arrival_date = Yii::$app->formatter->asDatetime($this->arrival_date, 'php:Y-m-d H:i');

        return true;
    }

    /**
     * Setups the possible flight airport for this model
     *
     */
    protected function setupPossibleFlightAirports()
    {
        $this->possible_flight_airports = Airport::getPossibleAirportsIDs();
        $this->possible_flight_airports_for_dropdown = Airport::getPossibleAirportsForDropdowns();
    }

    /**
     * Setups the possible flight airplane for this model
     *
     */
    protected function setupPossibleFlightAirplanes()
    {
        $this->possible_flight_airplanes = Airplane::getPossibleAirplanesIDs();
        $this->possible_flight_airplanes_for_dropdown = Airplane::getPossibleAirplanesForDropdowns();
    }

    /**
     * Gets query for [[Airplane]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAirplane()
    {
        return $this->hasOne(Airplane::class, ['id' => 'airplane_id']);
    }

    /**
     * Gets query for [[ArrivalAirport]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArrivalAirport()
    {
        return $this->hasOne(Airport::class, ['id' => 'arrival_airport_id']);
    }

    /**
     * Gets query for [[FlightTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlightTickets()
    {
        return $this->hasMany(FlightTicket::class, ['flight_id' => 'id']);
    }

    /**
     * Gets query for [[OriginAirport]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOriginAirport()
    {
        return $this->hasOne(Airport::class, ['id' => 'origin_airport_id']);
    }
}
