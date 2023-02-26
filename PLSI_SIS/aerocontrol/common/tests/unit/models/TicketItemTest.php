<?php


namespace common\tests\Unit\models;

use common\models\TicketItem;
use common\tests\UnitTester;

class TicketItemTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(TicketItem::class, [
            'lost_item_id' => 4,
            'support_ticket_id' => 1
        ]);
        $this->tester->seeRecord(TicketItem::class, [
            'lost_item_id' => 4,
            'support_ticket_id' => 1
        ]);
    }

    public function testRead()
    {
        $this->tester->seeRecord(TicketItem::class, [
            'lost_item_id' => 1,
            'support_ticket_id' => 1
        ]);
    }

    public function testDelete()
    {
        $ticketItem = $this->tester->grabRecord(TicketItem::class, [
            'lost_item_id' => 1,
            'support_ticket_id' => 1
        ]);
        $ticketItem->delete();
        $this->tester->dontSeeRecord(TicketItem::class, [
            'lost_item_id' => 1,
            'support_ticket_id' => 1
        ]);
    }
}
