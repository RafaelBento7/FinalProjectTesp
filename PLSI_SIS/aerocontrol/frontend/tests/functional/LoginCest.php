<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class LoginCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkEmpty(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Tem de escrever uma username.');
        $I->seeValidationError('Tem de escrever uma password.');
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('antonio', 'wrong'));
        $I->seeValidationError('Username ou Password erradas!');
    }

    public function checkValidLogin(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('antonio', '12345678'));
        $I->see('Logout');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
