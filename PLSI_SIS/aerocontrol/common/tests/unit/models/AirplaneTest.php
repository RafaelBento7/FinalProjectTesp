<?php


namespace common\tests\unit\models;

use common\models\Airplane;
use common\tests\UnitTester;

class AirplaneTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(Airplane::class, [
            'name' => 'airplane_test',
            'capacity' => '150',
            'state' => Airplane::STATE_ACTIVE,
            'company_id' => '1'
        ]);
        $this->tester->seeRecord(Airplane::class, ['name' => 'airplane_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(Airplane::class, ['name' => 'Hawker Hurricane']);
    }

    public function testUpdate()
    {
        $airplane = $this->tester->grabRecord(Airplane::class, [
            'name' => 'Hawker Hurricane'
        ]);
        $airplane->capacity = 1000;
        $this->assertTrue($airplane->save());
        $this->assertEquals(1000, $airplane->capacity);
    }
}
