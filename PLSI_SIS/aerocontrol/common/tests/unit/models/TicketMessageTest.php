<?php


namespace common\tests\Unit\models;

use common\models\TicketMessage;
use common\tests\UnitTester;

class TicketMessageTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(TicketMessage::class, [
            'message' => 'message_test',
            'sender_id' => 4,
            'support_ticket_id' => 1
        ]);
        $this->tester->seeRecord(TicketMessage::class, [
            'message' => 'message_test',
            'sender_id' => 4,
            'support_ticket_id' => 1
        ]);
    }

    public function testRead()
    {
        $this->tester->seeRecord(TicketMessage::class, [
            'message' => 'Bom dia, gostava de saber se foi encontrada uma camisola no voo Lisboa Faro no dia 3 de janeiro.',
            'sender_id' => 4,
            'support_ticket_id' => 1
        ]);
    }

    public function testUpdate()
    {
        $message = $this->tester->grabRecord(TicketMessage::class, [
            'message' => 'Bom dia, gostava de saber se foi encontrada uma camisola no voo Lisboa Faro no dia 3 de janeiro.',
            'sender_id' => 4,
            'support_ticket_id' => 1
        ]);
        $message->message = 'New message';
        $this->assertTrue($message->save());
        $this->assertEquals('New message', $message->message);
    }
}
