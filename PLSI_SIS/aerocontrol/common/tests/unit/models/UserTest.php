<?php


namespace common\tests\unit\models;

use common\models\Admin;
use common\models\Client;
use common\models\Employee;
use common\models\Manager;
use common\models\User;
use common\tests\UnitTester;

class UserTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    // tests
    public function testCreateUser()
    {
        $this->createUser();
        $this->tester->seeRecord(User::class, ['username' => 'test_user']);
    }

    public function testReadUser()
    {
        $this->tester->seeRecord(User::class, ['username' => 'rafael']);
    }

    public function testUpdate()
    {
        $user = $this->tester->grabRecord(User::class, [
            'username' => 'rafael'
        ]);
        $user->username = "Novo Nome";
        $this->assertTrue($user->save());
        $this->assertEquals('Novo Nome', $user->username);
    }

    public function testCreateAdmin()
    {
        $this->createUser();
        $user = $this->tester->grabRecord(User::class, [
            'username' => 'test_user'
        ]);
        $this->tester->haveRecord(Admin::class, [
            'admin_id' => $user->id,
        ]);
        $this->tester->seeRecord(Admin::class, ['admin_id' => $user->id]);
    }

    public function testCreateEmployee()
    {
        $this->createUser();
        $user = $this->tester->grabRecord(User::class, [
            'username' => 'test_user'
        ]);
        $this->tester->haveRecord(Employee::class, [
            'employee_id' => $user->id,
            'tin' => '321421521',
            'num_emp' => 'a123',
            'ssn' => '512125634',
            'street' => 'Rua do Largo nº15',
            'zip_code' => '2750-123',
            'iban' => 'PT50123321456654789987456',
            'qualifications' => 'Mestrado',
            'function_id' => 1
        ]);
        $this->tester->seeRecord(Employee::class, ['employee_id' => $user->id]);
    }

    public function testCreateClient()
    {
        $this->createUser();
        $user = $this->tester->grabRecord(User::class, [
            'username' => 'test_user'
        ]);
        $this->tester->haveRecord(Client::class, [
            'client_id' => $user->id,
        ]);
        $this->tester->seeRecord(Client::class, ['client_id' => $user->id]);
    }

    /**
     * Cria um User na DB para posteriormente criar o Admin/Manager/Employee/Client
     */
    public function testCreateManager()
    {
        $this->createUser();
        $user = $this->tester->grabRecord(User::class, [
            'username' => 'test_user'
        ]);
        $this->tester->haveRecord(Manager::class, [
            'manager_id' => $user->id,
            'restaurant_id' => 1
        ]);
        $this->tester->seeRecord(Manager::class, ['manager_id' => $user->id]);
    }



    public function createUser()
    {
        $this->tester->haveRecord(User::class, [
            'username' => 'test_user',
            'auth_key' => 'HP187Mvq7Mmm3CTU80dLkGmni_FUH_lR',
            'password_hash' => '$2y$13$EjaPFBnZOQsHdGuHI.xvhuDp1fHpo8hKRSk6yshqa9c5EG8s3C3lO',
            'password_reset_token' => 'ExzkCOaYc1L8IOBs4wdTGGbgNiG3Wz1I_1402312317',
            'status' => 10,
            'first_name' => 'test',
            'last_name' => 'user',
            'gender' => 'Masculino',
            'country' => 'Portugal',
            'city' => 'Lisboa',
            'birthdate' => '2002-08-07',
            'phone' => '913212321',
            'phone_country_code' => '+351',
            'created_at' => '1402312317',
            'updated_at' => '1402312317',
            'email' => 'test@test.pt',
        ]);
    }
}
