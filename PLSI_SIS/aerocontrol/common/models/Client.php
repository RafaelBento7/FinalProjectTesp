<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $client_id
 *
 * @property User $user
 * @property FlightTicket[] $flightTickets
 * @property SupportTicket[] $supportTickets
 */
class Client extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%client}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['client_id', 'required'],
            ['client_id', 'integer'],
            ['client_id', 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'boolean'],
            ['client_id', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'client_id' => 'ID do Cliente',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[FlightTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlightTickets()
    {
        return $this->hasMany(FlightTicket::class, ['client_id' => 'client_id']);
    }

    /**
     * Gets query for [[SupportTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTickets()
    {
        return $this->hasMany(SupportTicket::class, ['client_id' => 'client_id']);
    }
}
