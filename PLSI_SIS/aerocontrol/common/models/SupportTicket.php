<?php

namespace common\models;
use common\components\Mosquitto;
use Yii;
use yii\base\ErrorException;

/**
 * This is the model class for table "support_ticket".
 *
 * @property int $id
 * @property string $title
 * @property string $state
 * @property int $client_id
 *
 * @property Client $client
 * @property TicketItem[] $ticketItems
 * @property TicketMessage[] $ticketMessages
 */
class SupportTicket extends \yii\db\ActiveRecord
{

    const STATE_TO_REVIEW = "Por Rever";
    const STATE_DONE = "Concluido";
    const STATE_IN_PROGRESS = "Em Progresso";

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%support_ticket}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['state', 'default', 'value' => self::STATE_TO_REVIEW],
            [['title', 'state', 'client_id'], 'required'],
            [['title', 'state'], 'trim'],
            ['state', 'string'],
            [['state'], 'in', 'range' => [
                self::STATE_TO_REVIEW,
                self::STATE_IN_PROGRESS,
                self::STATE_DONE
            ]],
            ['title', 'string', 'max' => 20],
            ['client_id', 'integer'],
            ['client_id', 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'client_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Título',
            'state' => 'Estado',
            'client_id' => 'ID do Cliente',
        ];
    }

    /**
     * Adiciona um item ao support ticket
     * Nota: se existir já um item atribuido então dá [@throw ErrorException]
     * @param int $ticket_id ID do support ticket
     * @param LostItem $lostItem Lost Item a adicionar
     * @return bool|null
     * @throws ErrorException
     * @throws Throwable
     * @throws \yii\db\Exception
     */
    static public function addItemToSupportTicket(int $ticket_id, LostItem $lostItem)
    {
        $transaction = SupportTicket::getDb()->beginTransaction();

        try {
            $ticket = SupportTicket::findOne($ticket_id);
            if ($ticket->ticketItems)
                throw new ErrorException();

            $ticketItem = new TicketItem();
            $ticketItem->lost_item_id = $lostItem->id;
            $ticketItem->support_ticket_id = $ticket_id;

            $lostItem->state = LostItem::STATE_FOR_DELIVERING;

            if (!$lostItem->save())
                throw new ErrorException();
            if (!$ticketItem->save())
                throw new ErrorException();
            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            return null;
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
        return true;
    }



    /**
     * Remove um item do support ticket
     *
     * @param TicketItem $ticketItem
     * @param LostItem $lostItem
     * @return void
     */
    static public function removeItemFromSupportTicket(TicketItem $ticketItem, LostItem $lostItem)
    {
        $transaction = SupportTicket::getDb()->beginTransaction();

        try {
            if (!$ticketItem->delete())
                throw new ErrorException();

            $lostItem->state = LostItem::STATE_LOST;
            if (!$lostItem->save())
                throw new ErrorException();

            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            return null;
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
        return true;
    }

    /**
     * Conclui o support ticket
     * @return bool|null
     * @throws ErrorException
     * @throws Throwable
     */
    public function concludeSupportTicket()
    {
        $transaction = SupportTicket::getDb()->beginTransaction();

        try {
            $this->state = self::STATE_DONE;

            // Para cada ticket item, associado a este ticket, muda o estado dos mesmos para [[LostItem::STATE_DELIVERED]]
            foreach ($this->ticketItems as $ticketItem) {
                $correspondingLostItem = LostItem::findOne($ticketItem->lost_item_id);

                if ($correspondingLostItem !== null) {
                    $correspondingLostItem->state = LostItem::STATE_DELIVERED;
                    if (!$correspondingLostItem->save())
                        throw new ErrorException();
                }
            }

            if (!$this->save())
                throw new ErrorException();

            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            return null;
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert){
            $mosquitto = new Mosquitto();
            $mosquitto->FazPublishNoMosquitto("tickets", 'Novo ticket criado subscreva com "ticket-' . $this->id . '"');
        }

    }



    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['client_id' => 'client_id']);
    }

    /**
     * Gets query for [[TicketItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicketItems()
    {
        return $this->hasMany(TicketItem::class, ['support_ticket_id' => 'id']);
    }

    /**
     * Gets query for [[TicketMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicketMessages()
    {
        return $this->hasMany(TicketMessage::class, ['support_ticket_id' => 'id']);
    }
}
