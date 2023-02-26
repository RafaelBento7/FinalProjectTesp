<?php


namespace backend\tests\Functional;

use backend\models\EmployeeForm;
use backend\tests\FunctionalTester;
use common\models\Employee;
use common\models\User;

class EmployeeCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('employee/create');
    }

    public function createEmployeeEmptyForm(FunctionalTester $I)
    {
        $I->see("Criar Trabalhador", 'h1');
        $I->submitForm('#employee-form', []);
        $I->seeValidationError('É necessário um username.');
        $I->seeValidationError('É necessário uma password.');
        $I->seeValidationError('É necessário o nº de empregado.');
        $I->seeValidationError('É necessário o primeiro nome.');
        $I->seeValidationError('É necessário o último nome.');
        $I->seeValidationError('É necessária a data de nascimento.');
        $I->seeValidationError('É necessário o país.');
        $I->seeValidationError('É necessário a cidade.');
        $I->seeValidationError('É necessário um email.');
        $I->seeValidationError('É necessário o indicativo do nº de telemóvel.');
        $I->seeValidationError('É necessário o nº de telemóvel.');
        $I->seeValidationError('É necessário o nº de contribuinte.');
        $I->seeValidationError('É necessário o nº de segurança social.');
        $I->seeValidationError('É necessário o iban.');
        $I->seeValidationError('É necessário a qualificação.');
        $I->seeValidationError('É necessário a função.');
        $I->seeValidationError('É necessário o código postal.');
        $I->seeValidationError('É necessário o nome da rua.');
    }

    public function createEmployeeRepeatedUsername(FunctionalTester $I)
    {
        $I->see("Criar Trabalhador", 'h1');
        $I->submitForm('#employee-form', [
            'EmployeeForm[username]'  => 'pedro',
            'EmployeeForm[password_hash]'  => '12345678',
            'EmployeeForm[email]'     => 'tester@gmail.com',
            'EmployeeForm[first_name]'  => 'tester',
            'EmployeeForm[last_name]'  => 'user',
            'EmployeeForm[gender]'  => 'Masculino',
            'EmployeeForm[birthdate]'  => '2000-03-15',
            'EmployeeForm[country]'  => 'Portugal',
            'EmployeeForm[city]'  => 'Lisboa',
            'EmployeeForm[phone]'  => '912345678',
            'EmployeeForm[phone_country_code]'  => '+351',
            'EmployeeForm[num_emp]'  => 'a1232',
            'EmployeeForm[tin]'  => '123123123',
            'EmployeeForm[ssn]'  => '321321321',
            'EmployeeForm[iban]'  => 'PT501234567891234567899876',
            'EmployeeForm[qualifications]'  => 'Piloto',
            'EmployeeForm[function_id]'  => 1,
            'EmployeeForm[street]'  => 'Rua x',
            'EmployeeForm[zip_code]'  => '1324-321',
        ]);

        $I->seeValidationError('Este username já está a ser utilizado.');
        $I->dontSeeValidationError('É necessário uma password.');
        $I->dontSeeValidationError('É necessário o nº de empregado.');
        $I->dontSeeValidationError('É necessário o primeiro nome.');
        $I->dontSeeValidationError('É necessário o último nome.');
        $I->dontSeeValidationError('É necessária a data de nascimento.');
        $I->dontSeeValidationError('É necessário o país.');
        $I->dontSeeValidationError('É necessário a cidade.');
        $I->dontSeeValidationError('É necessário um email.');
        $I->dontSeeValidationError('É necessário o indicativo do nº de telemóvel.');
        $I->dontSeeValidationError('É necessário o nº de telemóvel.');
        $I->dontSeeValidationError('É necessário o nº de contribuinte.');
        $I->dontSeeValidationError('É necessário o nº de segurança social.');
        $I->dontSeeValidationError('É necessário o iban.');
        $I->dontSeeValidationError('É necessário a qualificação.');
        $I->dontSeeValidationError('É necessário a função.');
        $I->dontSeeValidationError('É necessário o código postal.');
        $I->dontSeeValidationError('É necessário o nome da rua.');
    }

    public function createEmployee(FunctionalTester $I)
    {
        $I->see("Criar Trabalhador", 'h1');
        $I->submitForm('#employee-form', [
            'EmployeeForm[username]'  => 'tester',
            'EmployeeForm[password_hash]'  => '12345678',
            'EmployeeForm[email]'     => 'tester@gmail.com',
            'EmployeeForm[first_name]'  => 'tester',
            'EmployeeForm[last_name]'  => 'user',
            'EmployeeForm[gender]'  => 'Masculino',
            'EmployeeForm[birthdate]'  => '2000-03-15',
            'EmployeeForm[country]'  => 'Portugal',
            'EmployeeForm[city]'  => 'Lisboa',
            'EmployeeForm[phone]'  => '912345678',
            'EmployeeForm[phone_country_code]'  => '+351',
            'EmployeeForm[num_emp]'  => 'a1232',
            'EmployeeForm[tin]'  => '123123123',
            'EmployeeForm[ssn]'  => '321321321',
            'EmployeeForm[iban]'  => 'PT50123456789123456789987',
            'EmployeeForm[qualifications]'  => 'Mestrado',
            'EmployeeForm[function_id]'  => 1,
            'EmployeeForm[street]'  => 'Rua x',
            'EmployeeForm[zip_code]'  => '1324-321',
        ]);


        $I->seeRecord(User::class, [
            'username' => 'tester',
            'email' => 'tester@gmail.com',
        ]);

        $user = $I->grabRecord(User::class, [
            'username' => 'tester',
            'email' => 'tester@gmail.com',
        ]);

        $I->seeRecord(Employee::class, [
            'employee_id' => $user->id,
        ]);
    }
}
