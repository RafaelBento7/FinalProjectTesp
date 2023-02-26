<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_method".
 *
 * @property int $id
 * @property string $name
 * @property int $state
 *
 * @property FlightTicket[] $flightTickets
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    const STATE_ACTIVE = 1;
    const STATE_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%payment_method}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'state'], 'required', 'message' => '{attribute} não pode ser vazio.'],
            ['state', 'boolean', 'message' => 'Selecione um dos estados.'],
            ['name', 'trim'],
            ['name', 'string', 'max' => 50, 'message' => '{attribute} não pode exceder os 50 caracteres.'],
            ['name', 'unique', 'targetClass' => '\common\models\PaymentMethod', 'message' => 'Este nome já está a ser utilizado.'],
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
     * Gets query for [[FlightTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlightTickets()
    {
        return $this->hasMany(FlightTicket::class, ['payment_method_id' => 'id']);
    }
}
