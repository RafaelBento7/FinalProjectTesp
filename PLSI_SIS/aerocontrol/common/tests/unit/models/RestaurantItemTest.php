<?php


namespace common\tests\Unit\models;

use common\models\RestaurantItem;
use common\tests\UnitTester;

class RestaurantItemTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(RestaurantItem::class, [
            'item' => 'item_test',
            'image' => 'item_test_15-12-2022_20-49.png',
            'state' => RestaurantItem::STATE_ACTIVE,
            'restaurant_id' => 1
        ]);
        $this->tester->seeRecord(RestaurantItem::class, ['item' => 'item_test']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(RestaurantItem::class, ['item' => 'Big Mac']);
    }

    public function testUpdate()
    {
        $item = $this->tester->grabRecord(RestaurantItem::class, [
            'item' => 'Big Mac'
        ]);
        $item->item = 'New Item name';
        $this->assertTrue($item->save());
        $this->assertEquals('New Item name', $item->item);
    }
}
