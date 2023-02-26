<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "airplane".
 *
 * @property int $id
 * @property string $name
 * @property int $capacity
 * @property int $state
 * @property int $company_id
 *
 * @property Company $company
 * @property Flight[] $flights
 */
class Airplane extends \yii\db\ActiveRecord
{
    const STATE_ACTIVE = 1;
    const STATE_INACTIVE = 0;

    private $possible_airplane_companies;
    public $possible_airplane_companies_for_dropdown;


    public function __construct($config = [])
    {
        // Setups the possible values for airplane company
        $this->setupPossibleAirplaneCompanies();



        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%airplane}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'capacity', 'state', 'company_id'], 'required', 'message' => "{attribute} não pode ser vazio."],
            [['capacity', 'company_id'], 'integer', 'message' => "{attribute} tem que ser um número."],
            ['state', 'boolean'],

            ['name', 'trim'],
            [
                'name', 'string',
                'max' => 75, 'tooLong' => "O nome do avião não pode exceder os 75 caracteres."
            ],
            ['name', 'unique', 'targetClass' => '\common\models\Airplane', 'message' => 'Este nome já está a ser utilizado.'],

            ['company_id', 'in', 'range' => $this->possible_airplane_companies, 'message' => 'Companhia inválida'],
            ['company_id', 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'capacity' => 'Capacidade',
            'state' => 'Estado',
            'company_id' => 'Companhia',
        ];
    }

    /**
     * Setups the possible airplane companies for this model
     *
     */
    protected function setupPossibleAirplaneCompanies()
    {
        $this->possible_airplane_companies = Company::getPossibleCompaniesIDs();
        $this->possible_airplane_companies_for_dropdown = Company::getPossibleCompaniesForDropdowns();
    }

    /**
     * Getter for airplane state in string
     */
    public function getState()
    {
        return $this->state == self::STATE_INACTIVE ? "Inativo" : "Ativo";
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }

    /**
     * Gets query for [[Flights]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlights()
    {
        return $this->hasMany(Flight::class, ['airplane_id' => 'id']);
    }

    /**
     * Get all airplanes IDs
     * @return array
     */
    public static function getPossibleAirplanesIDs()
    {
        $possibleAirplanes = self::find()->select(['id'])->all();

        // Makes an array of ID´s from all the possible companies
        return ArrayHelper::getColumn($possibleAirplanes, 'id');
    }

    /**
     * Get all the airplanes for dropdowns
     * @return array
     */
    public static function getPossibleAirplanesForDropdowns()
    {
        $possibleAirplanes = self::find()->select(['id', 'name'])->all();

        // Maps the array containing the companies to an associative array of 'id' => 'name'
        return ArrayHelper::map($possibleAirplanes, 'id', 'name');
    }
}
