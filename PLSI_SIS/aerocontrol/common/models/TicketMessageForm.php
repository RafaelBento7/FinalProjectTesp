<?php

namespace common\models;

use common\models\SupportTicket;
use common\models\TicketMessage;
use yii\base\ErrorException;
use yii\base\Model;

class TicketMessageForm extends Model
{
    public $message;

    public $sender_id;
    public $support_ticket_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['message', 'required', 'message' => "A mensagem não pode ser vazia."],
            [
                'message',
                'string', 'message' => 'A mensagem tem de conter apenas caracteres.',
                'max' => 255, 'tooLong' => "A mensagem não pode exceder os 255 caracteres."
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'message' => 'Mensagem',
        ];
    }

    /**
     * Cria um ticketMessage 
     *
     * @param SupportTicket|null $ticket
     * @return void
     */
    public function create(SupportTicket $ticket = null)
    {

        if (!$this->validate()) {
            return false;
        }
        $transaction = TicketMessage::getDb()->beginTransaction();
        try {
            $supportTicketMessage = new TicketMessage();
            $supportTicketMessage->message = $this->message;
            $supportTicketMessage->sender_id = $this->sender_id;
            $supportTicketMessage->support_ticket_id = $this->support_ticket_id;

            if (!$supportTicketMessage->save()) {
                throw new ErrorException();
            }

            if ($ticket != null) {
                // Verifica se não é um cliente a enviar a mensagem e se o estado do ticket ainda está "Em Review"
                // case isto seja verdadde então passa o o estado do ticket para "Em Progresso"
                if ($this->sender_id != $ticket->client_id && $ticket->state === SupportTicket::STATE_TO_REVIEW) {
                    $ticket->state = SupportTicket::STATE_IN_PROGRESS;
                    if (!$ticket->save()) {
                        throw new ErrorException();
                    }
                }
            }


            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            return null;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
        return true;
    }
}
