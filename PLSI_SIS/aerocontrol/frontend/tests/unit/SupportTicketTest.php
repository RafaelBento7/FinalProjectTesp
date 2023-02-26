<?php


namespace frontend\tests\Unit;

use common\models\SupportTicket;
use common\models\TicketMessage;
use common\models\SupportTicketForm;
use frontend\tests\UnitTester;

class SupportTicketTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreateSupportTicket()
    {
        $sup = new SupportTicketForm();
        $sup->client_id = 4;
        $sup->message = "NovoMensagem_123312123csaddas";
        $sup->title = "NovoTicket_123312123";

        $this->assertTrue($sup->create());

        $this->tester->seeRecord(SupportTicket::class, [
            'title' => 'NovoTicket_123312123'
        ]);

        $this->tester->seeRecord(TicketMessage::class, [
            'message' => 'NovoMensagem_123312123csaddas'
        ]);
    }
}
