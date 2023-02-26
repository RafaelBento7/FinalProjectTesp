<?php


namespace common\tests\Unit\models;

use common\models\Employee;
use common\models\EmployeeFunction;
use common\tests\UnitTester;

class EmployeeFunctionTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(EmployeeFunction::class, [
            'name' => 'employee_function_test',
        ]);
        $this->tester->seeRecord(EmployeeFunction::class, ['name' => 'employee_function_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(EmployeeFunction::class, ['name' => 'Limpeza']);
    }

    public function testUpdate()
    {
        $employeeFunction = $this->tester->grabRecord(EmployeeFunction::class, [
            'name' => 'Limpeza'
        ]);
        $employeeFunction->name = 'New Function name';
        if (!$employeeFunction->save())
            dump($employeeFunction->errors);

        $this->assertTrue($employeeFunction->save());
        $this->assertEquals('New Function name', $employeeFunction->name);
    }
}
