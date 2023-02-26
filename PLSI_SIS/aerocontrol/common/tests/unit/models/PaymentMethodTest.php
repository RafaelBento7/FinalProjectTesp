<?php


namespace common\tests\Unit\models;

use common\models\PaymentMethod;
use common\tests\UnitTester;

class PaymentMethodTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(PaymentMethod::class, [
            'name' => 'method_test',
            'state' => PaymentMethod::STATE_ACTIVE,
        ]);
        $this->tester->seeRecord(PaymentMethod::class, ['name' => 'method_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(PaymentMethod::class, ['name' => 'MBWay']);
    }

    public function testUpdate()
    {
        $paymentMethod = $this->tester->grabRecord(PaymentMethod::class, [
            'name' => 'MBWay'
        ]);
        $paymentMethod->name = 'New method name';
        $this->assertTrue($paymentMethod->save());
        $this->assertEquals('New method name', $paymentMethod->name);
    }
}
