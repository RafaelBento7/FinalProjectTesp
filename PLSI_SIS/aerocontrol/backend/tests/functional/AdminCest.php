<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\models\Admin;
use common\models\User;

class AdminCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('admin/create');
    }

    public function createAdminEmptyForm(FunctionalTester $I)
    {
        $I->see("Criar Administrador", 'h1');
        $I->submitForm('#admin-form', []);
        $I->seeValidationError('É necessário um username.');
        $I->seeValidationError('É necessário uma password.');
        $I->seeValidationError('É necessário o primeiro nome.');
        $I->seeValidationError('É necessário o último nome.');
        $I->seeValidationError('É necessária a data de nascimento.');
        $I->seeValidationError('É necessário o país.');
        $I->seeValidationError('É necessário a cidade.');
        $I->seeValidationError('É necessário um email.');
        $I->seeValidationError('É necessário o indicativo do nº de telemóvel.');
        $I->seeValidationError('É necessário o nº de telemóvel.');
    }

    public function createAdminRepeatedUsername(FunctionalTester $I)
    {
        $I->see("Criar Administrador", 'h1');
        $I->submitForm('#admin-form', [
            'AdminForm[username]' => 'rafael',
            'AdminForm[password_hash]' => '12345678',
            'AdminForm[email]' => 'tester@gmail.com',
            'AdminForm[first_name]' => 'tester',
            'AdminForm[last_name]' => 'user',
            'AdminForm[gender]' => 'Masculino',
            'AdminForm[birthdate]' => '2000-03-15',
            'AdminForm[country]' => 'Portugal',
            'AdminForm[city]' => 'Lisboa',
            'AdminForm[phone]' => '912345678',
            'AdminForm[phone_country_code]'  => '+351',
        ]);

        $I->seeValidationError('Este username já está a ser utilizado.');
    }

    public function createAdmin(FunctionalTester $I)
    {
        $I->see("Criar Administrador", 'h1');
        $I->submitForm('#admin-form', [
            'AdminForm[username]'  => 'tester',
            'AdminForm[password_hash]' => '12345678',
            'AdminForm[email]' => 'tester@gmail.com',
            'AdminForm[first_name]' => 'tester',
            'AdminForm[last_name]' => 'user',
            'AdminForm[gender]' => 'Masculino',
            'AdminForm[birthdate]' => '2000-03-15',
            'AdminForm[country]' => 'Portugal',
            'AdminForm[city]' => 'Lisboa',
            'AdminForm[phone]' => '912345678',
            'AdminForm[phone_country_code]'  => '+351',
        ]);

        $I->seeRecord(User::class, [
            'username' => 'tester',
            'email' => 'tester@gmail.com',
        ]);

        $user = $I->grabRecord(User::class, [
            'username' => 'tester',
            'email' => 'tester@gmail.com',
        ]);

        $I->seeRecord(Admin::class, [
            'admin_id' => $user->id,
        ]);
    }
}
