<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name
 * @property int $state
 *
 * @property Airplane[] $airplanes
 */
class Company extends \yii\db\ActiveRecord
{
    const STATE_ACTIVE = 1;
    const STATE_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required', 'message' => '{attribute} não pode ser vazio.'],
            ['name', 'trim'],
            ['name', 'string', 'max' => 50, 'message' => '{attribute} não pode exceder os 50 caracteres.'],
            ['name', 'unique', 'targetClass' => '\common\models\Company', 'message' => 'Este nome já está a ser utilizado.'],
            ['state', 'boolean', 'message' => 'Selecione um dos estados.'],
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
     * Getter for company state in string
     */
    public function getState()
    {
        return $this->state == self::STATE_INACTIVE ? "Inativo" : "Ativo";
    }

    /**
     * Gets query for [[Airplanes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAirplanes()
    {
        return $this->hasMany(Airplane::class, ['company_id' => 'id']);
    }



    /**
     * Get all companies IDs
     * @return array
     */
    public static function getPossibleCompaniesIDs()
    {
        $possibleCompanies = self::find()->select(['id'])->where(['state' => self::STATE_ACTIVE])->all();

        // Makes an array of ID´s from all the possible companies
        return ArrayHelper::getColumn($possibleCompanies, 'id');
    }

    /**
     * Get all the companies for dropdowns
     * @return array
     */
    public static function getPossibleCompaniesForDropdowns()
    {
        $possibleCompanies = self::find()->select(['id', 'name'])->where(['state' => self::STATE_ACTIVE])->all();

        // Maps the array containing the companies to an associative array of 'id' => 'name'
        return ArrayHelper::map($possibleCompanies, 'id', 'name');
    }
}
