<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket_item".
 *
 * @property int $lost_item_id
 * @property int $support_ticket_id
 *
 * @property LostItem $lostItem
 * @property SupportTicket $supportTicket
 */
class TicketItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ticket_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lost_item_id', 'support_ticket_id'], 'required'],
            [['lost_item_id', 'support_ticket_id'], 'integer'],
            ['lost_item_id', 'unique'],
            ['lost_item_id', 'exist', 'skipOnError' => true, 'targetClass' => LostItem::class, 'targetAttribute' => ['lost_item_id' => 'id']],
            ['support_ticket_id', 'exist', 'skipOnError' => true, 'targetClass' => SupportTicket::class, 'targetAttribute' => ['support_ticket_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lost_item_id' => 'ID do Item',
            'support_ticket_id' => 'ID do Ticket de Suporte',
        ];
    }

    /**
     * Gets query for [[LostItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLostItem()
    {
        return $this->hasOne(LostItem::class, ['id' => 'lost_item_id']);
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
