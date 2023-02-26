<?php


namespace common\tests\Unit\models;

use common\models\Flight;
use common\tests\UnitTester;

class FlightTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(Flight::class, [
            'terminal' => 'T4',
            'estimated_departure_date' => '2023-03-27 13:30:00',
            'estimated_arrival_date' => '2023-03-27 14:30:00',
            'departure_date' => '2023-03-27 13:30:00',
            'arrival_date' => '2023-03-27 14:30:00',
            'price' => '90',
            'distance' => '300',
            'state' => 'Previsto',
            'discount_percentage' => 0,
            'passengers_left' => 100,
            'origin_airport_id' => 2,
            'arrival_airport_id' => 1,
            'airplane_id' => 2
        ]);

        $this->tester->seeRecord(Flight::class, [
            'terminal' => 'T4',
            'price' => '90',
            'distance' => '300',
            'state' => 'Previsto',
            'discount_percentage' => 0,
            'passengers_left' => 100,
            'origin_airport_id' => 2,
            'arrival_airport_id' => 1,
            'airplane_id' => 2
        ]);
    }

    public function testRead()
    {
        $this->tester->seeRecord(Flight::class, [
            'terminal' => 'T1',
            'price' => '100',
            'distance' => '300',
            'state' => 'Previsto',
            'discount_percentage' => 0,
            'passengers_left' => 120,
            'origin_airport_id' => 1,
            'arrival_airport_id' => 3,
            'airplane_id' => 1
        ]);
    }

    public function testUpdate()
    {
        $flight = $this->tester->grabRecord(Flight::class, [
            'terminal' => 'T1',
            'price' => '100',
            'distance' => '300',
            'state' => 'Previsto',
            'discount_percentage' => 0,
            'passengers_left' => 120,
            'origin_airport_id' => 1,
            'arrival_airport_id' => 3,
            'airplane_id' => 1
        ]);
        $flight->terminal = 'T15';
        $this->assertTrue($flight->save());
        $this->assertEquals('T15', $flight->terminal);
    }
}
