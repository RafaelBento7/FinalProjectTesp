<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employee_function".
 *
 * @property int $id
 * @property string $name
 * @property string $state
 *
 * @property Employee[] $employees
 */
class EmployeeFunction extends \yii\db\ActiveRecord
{

    const STATE_ACTIVE = 1;
    const STATE_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%employee_function}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required', 'message' => '{attribute} não pode ser vazio.'],
            [
                'name', 'string',
                'max' => 50, 'tooLong' => 'O nome não pode exceder os 50 caracteres.'
            ],
            ['name', 'unique', 'message' => 'Este nome já está a ser utilizado.'],

            ['state', 'boolean'],
            ['state', 'default', 'value' => self::STATE_ACTIVE],
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
            'state' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::class, ['function_id' => 'id']);
    }

    /**
     * Getter for employeefunction state in string
     */
    public function getState()
    {
        return $this->state == self::STATE_INACTIVE ? "Inativo" : "Ativo";
    }

    /**
     * Get all employeeFunctions IDs
     * @return array
     */
    public static function getPossibleEmployeeFunctionsIDs()
    {
        $possibleEmployeeFunctions = self::find()->select(['id'])->all();

        // Makes an array of ID´s from all the possible employee functions
        return ArrayHelper::getColumn($possibleEmployeeFunctions, 'id');
    }

    /**
     * Get all the employeeFunctions for dropdowns
     * @return array
     */
    public static function getPossibleEmployeeFunctionsForDropdowns()
    {
        $possibleEmployeeFunctions = self::find()->select(['id', 'name'])->all();

        // Maps the array containing the employeeFunctions to an associative array of 'id' => 'name'
        return ArrayHelper::map($possibleEmployeeFunctions, 'id', 'name');
    }
}
