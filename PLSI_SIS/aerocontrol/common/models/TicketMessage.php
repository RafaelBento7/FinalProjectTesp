<?php

namespace common\models;

use common\components\Mosquitto;
use Yii;

/**
 * This is the model class for table "ticket_message".
 *
 * @property int $id
 * @property string $message
 * @property int $sender_id
 * @property int $support_ticket_id
 *
 * @property SupportTicket $supportTicket
 */
class TicketMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ticket_message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'sender_id', 'support_ticket_id'], 'required'],
            [['sender_id', 'support_ticket_id'], 'integer'],
            [ 'message', 'trim'],
            ['message', 'string', 'max' => 255],
            ['support_ticket_id', 'exist', 'skipOnError' => true, 'targetClass' => SupportTicket::class, 'targetAttribute' => ['support_ticket_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Mensagem',
            'sender_id' => 'ID do Emissor',
            'support_ticket_id' => 'ID do Ticket de Suporte',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert){
            $mosquitto = new Mosquitto();
            $mosquitto->FazPublishNoMosquitto("ticket-".$this->supportTicket->id, 'Nova mensagem no ticket-' . $this->id . '"');
        }
    }

    /**
     * Gets query for [[SupportTicket]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTicket()
    {
        return $this->hasOne(SupportTicket::class, ['id' => 'support_ticket_id']);
    }
}
