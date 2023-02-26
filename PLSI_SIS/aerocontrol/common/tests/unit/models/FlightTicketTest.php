<?php


namespace common\tests\Unit\models;

use common\models\FlightTicket;
use common\tests\UnitTester;

class FlightTicketTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(FlightTicket::class, [
            'price' => 200,
            'purchase_date' => '2022-12-25 11:30:00',
            'checkin' => 0,
            'client_id' => 4,
            'flight_id' => 3,
            'payment_method_id' => 1

        ]);
        $this->tester->seeRecord(FlightTicket::class, [
            'checkin' => 0,
            'client_id' => 4,
            'flight_id' => 3,
            'payment_method_id' => 1
        ]);
    }

    public function testRead()
    {
        $this->tester->seeRecord(FlightTicket::class, [
            'checkin' => 0,
            'client_id' => 4,
            'flight_id' => 1,
            'payment_method_id' => 1
        ]);
    }

    public function testUpdate()
    {
        $flightTicket = $this->tester->grabRecord(FlightTicket::class, [
            'checkin' => 0,
            'client_id' => 4,
            'flight_id' => 1,
            'payment_method_id' => 1
        ]);
        $flightTicket->checkin = 1;
        $this->assertTrue($flightTicket->save());
        $this->assertEquals(1, $flightTicket->checkin);
    }

    public function testDelete()
    {
        $flightTicket = $this->tester->grabRecord(FlightTicket::class, [
            'checkin' => 0,
            'client_id' => 4,
            'flight_id' => 1,
            'payment_method_id' => 1
        ]);
        if(!$flightTicket->deleteTicket()) dump($flightTicket->errors);  // Função costumizada para dar delete a passageiros e após isso ao ticket
        $this->tester->dontSeeRecord(FlightTicket::class, ['flight_ticket_id' => $flightTicket->flight_ticket_id]);
    }
}
