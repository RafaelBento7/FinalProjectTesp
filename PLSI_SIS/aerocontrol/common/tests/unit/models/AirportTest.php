<?php


namespace common\tests\Unit\models;

use common\models\Airport;
use common\tests\UnitTester;

class AirportTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(Airport::class, [
            'country' => 'Portugal',
            'city' => 'Lisboa',
            'name' => 'airport_test',
            'website' => 'www.testAirport.pt'
        ]);
        $this->tester->seeRecord(Airport::class, ['name' => 'airport_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(Airport::class, ['name' => 'ANA Aeroporto do Porto']);
    }

    public function testUpdate()
    {
        $airport = $this->tester->grabRecord(Airport::class, [
            'name' => 'ANA Aeroporto do Porto'
        ]);
        $airport->name = 'New airport name';
        $this->assertTrue($airport->save());
        $this->assertEquals('New airport name', $airport->name);
    }
}
