<?php

namespace common\models;

use common\models\FlightTicket;
use common\models\SupportTicket;
use common\models\TicketMessage;
use Yii;
use yii\base\ErrorException;
use yii\base\Model;

class SupportTicketForm extends Model
{
    public $title;
    public $message;

    public $client_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['title', 'required', 'message' => "Titulo não pode ser vazio."],
            ['message', 'required', 'message' => "Mensagem não pode ser vazio."],
            ['title', 'string', 'max' => 20, 'tooLong' => '{attribute} não pode exceder os 20 caracteres.'],
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
            'title' => 'Titulo:',
            'message' => 'Mensagem:',
        ];
    }

    public function create()
    {

        if (!$this->validate()) {
            return false;
        }
        $transaction = SupportTicket::getDb()->beginTransaction();
        try {
            $supportTicket = new SupportTicket();
            $supportTicket->title = $this->title;
            $supportTicket->client_id = $this->client_id;

            if (!$supportTicket->save()) {
                throw new ErrorException();
            }

            $supportTicketFirstMessage = new TicketMessage();
            $supportTicketFirstMessage->message = $this->message;
            $supportTicketFirstMessage->sender_id = $this->client_id;

            $supportTicketFirstMessage->support_ticket_id = $supportTicket->id;

            if (!$supportTicketFirstMessage->save()) {
                throw new ErrorException();
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
