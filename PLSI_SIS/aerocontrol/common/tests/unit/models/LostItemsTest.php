<?php


namespace common\tests\Unit\models;

use common\models\LostItem;
use common\tests\UnitTester;

class LostItemsTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    public function testCreate()
    {
        $this->tester->haveRecord(LostItem::class, [
            'description' => 'Green Shirt',
            'state' => 'Perdido',
            'image' => '20-11-2022_20-03-20.jpg', // Formato utilizado para guardar imagens dia-mês-ano_hora-minuto-segundo
        ]);
        $this->tester->seeRecord(LostItem::class, ['description' => 'Green Shirt']);
    }

    public function testRead()
    {
        $this->tester->seeRecord(LostItem::class, ['description' => 'Camisa vermelha, marca BOSS.']);
    }

    public function testUpdate()
    {
        $lostItem = $this->tester->grabRecord(LostItem::class, [
            'description' => 'Camisa vermelha, marca BOSS.'
        ]);
        $lostItem->description = 'New description';
        $this->assertTrue($lostItem->save());
        $this->assertEquals('New description', $lostItem->description);
    }
}
