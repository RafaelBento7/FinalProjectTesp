<?php

namespace frontend\tests\functional;

use common\models\User;
use common\models\SignupForm;
use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#signup-form';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Criar Conta', 'h1');
        $I->see('Crie a sua conta para começar a reservar voos e muito mais.');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('É necessário um username.');
        $I->seeValidationError('É necessário uma password.');
        $I->seeValidationError('É necessário o primeiro nome.');
        $I->seeValidationError('É necessário o último nome.');
        $I->seeValidationError('É necessário o género.');
        $I->seeValidationError('É necessária a data de nascimento.');
        $I->seeValidationError('É necessário o país.');
        $I->seeValidationError('É necessário a cidade.');
        $I->seeValidationError('É necessário um email.');
        $I->seeValidationError('É necessário o indicativo do nº de telemóvel.');
        $I->seeValidationError('É necessário o nº de telemóvel.');
    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId,
            [
                'SignupForm[username]'  => 'tester',
                'SignupForm[email]'     => 'ttttt',
                'SignupForm[password_hash]'  => '12345678',
                'SignupForm[first_name]'  => 'tester',
                'SignupForm[last_name]'  => 'user',
                'SignupForm[gender]'  => 'Masculino',
                'SignupForm[birthdate]'  => '2000-03-15',
                'SignupForm[country]'  => 'Portugal',
                'SignupForm[city]'  => 'Lisboa',
                'SignupForm[phone]'  => '912345678',
                'SignupForm[phone_country_code]'  => '+351',
            ]
        );
        $I->dontSeeValidationError('É necessário um username.');
        $I->dontSeeValidationError('É necessário uma password.');
        $I->dontSeeValidationError('É necessário o primeiro nome.');
        $I->dontSeeValidationError('É necessário o último nome.');
        $I->dontSeeValidationError('É necessário o género.');
        $I->dontSeeValidationError('É necessária a data de nascimento.');
        $I->dontSeeValidationError('É necessário o país.');
        $I->dontSeeValidationError('É necessário a cidade.');
        $I->dontSeeValidationError('É necessário o indicativo do nº de telemóvel.');
        $I->dontSeeValidationError('É necessário o nº de telemóvel.');
        $I->seeValidationError('Email inválido.');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId,
            [
                'SignupForm[username]'  => 'tester',
                'SignupForm[email]'     => 'tester@gmail.com',
                'SignupForm[password_hash]'  => '12345678',
                'SignupForm[first_name]'  => 'tester',
                'SignupForm[last_name]'  => 'user',
                'SignupForm[gender]'  => 'Masculino',
                'SignupForm[birthdate]'  => '2000-03-15',
                'SignupForm[country]'  => 'Portugal',
                'SignupForm[city]'  => 'Lisboa',
                'SignupForm[phone]'  => '912345678',
                'SignupForm[phone_country_code]'  => '+351',
            ]
        );

        $I->seeRecord(User::class, [
            'username' => 'tester',
            'email' => 'tester@gmail.com',

        ]);

        $I->seeEmailIsSent();
        $I->see('Registo efetuado. Por favor verifique o seu email para concluir o registo!');
    }
}
