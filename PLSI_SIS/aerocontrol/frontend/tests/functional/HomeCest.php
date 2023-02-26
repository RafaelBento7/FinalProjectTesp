<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use Yii;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->see('Home');
        $I->see('Voos');
        $I->see('Restaurantes');
        $I->see('Lojas');
        $I->see('Reserve já o seu próximo voo!');
        $I->see('Reservar');
        $I->seeLink('Voos');
        $I->click('Voos');
        $I->see('Reserve agora o seu voo');
    }
}