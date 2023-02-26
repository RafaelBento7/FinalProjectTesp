<?php


namespace common\tests\Unit\models;

use common\models\Store;
use common\tests\UnitTester;

class StoreTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(Store::class, [
            'name' => 'store_test',
            'description' => 'Loja de roupa',
            'phone' => '919300122',
            'open_time' => '05:00:00',
            'close_time' => '01:00:00',
            'logo' => 'store_15-12-2022_20-49.png',
            'website' => 'www.store.pt'
        ]);
        $this->tester->seeRecord(Store::class, ['name' => 'store_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(Store::class, ['name' => 'Acium']);
    }
}
