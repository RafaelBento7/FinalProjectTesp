<?php


namespace common\tests\Unit\models;

use common\models\SupportTicket;
use common\tests\UnitTester;

class SupportTicketTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(SupportTicket::class, [
            'title' => 'ticket_test',
            'state' => SupportTicket::STATE_DONE,
            'client_id' => 5
        ]);
        $this->tester->seeRecord(SupportTicket::class, ['title' => 'ticket_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(SupportTicket::class, ['title' => 'Camisola Perdida']);
    }

    public function testUpdate()
    {
        $ticket = $this->tester->grabRecord(SupportTicket::class, [
            'title' => 'Camisola Perdida'
        ]);
        $ticket->title = 'New ticket name';
        $this->assertTrue($ticket->save());
        $this->assertEquals('New ticket name', $ticket->title);
    }
}
