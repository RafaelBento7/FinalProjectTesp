<?php

namespace backend\models;

use common\models\base\UserForm;
use common\models\Employee;
use common\models\EmployeeFunction;
use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;

class EmployeeForm extends UserForm
{
    private $possible_employee_qualifications = Employee::POSSIBLE_QUALIFICATIONS;
    public $possible_employee_qualifications_for_dropdown = Employee::POSSIBLE_QUALIFICATIONS_FOR_DROPDOWN;

    private $possible_employee_functions;
    public $possible_employee_functions_for_dropdown;

    // Employee
    public $employee_id;
    public $tin;
    public $num_emp;
    public $ssn;
    public $street;
    public $zip_code;
    public $iban;
    public $qualifications;
    public $function_id;

    private $_employee;

    public function __construct($employee_id = null, $config = [])
    {

        $this->setupPossibleEmployeeFunctions();


        // Se existir um employee_id então dá setup do correspondente Employee com este form
        if ($employee_id !== null) {
            $this->setupEmployeeOnForm($employee_id);
        }

        // Se existir um employee_id então dá setup do correspondente User com este form
        parent::__construct($employee_id, $config);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = parent::rules();
        $newRules =
            [
                // Employee
                [['tin', 'num_emp', 'ssn', 'zip_code', 'street', 'iban', 'qualifications'], 'trim'],

                ['tin', 'required', 'message' => "É necessário o nº de contribuinte."],
                [
                    'tin', 'string',
                    'max' => 20, 'tooLong' => "O nº de contribuinte não pode exceder os 20 caracteres."
                ],
                [
                    'tin', 'unique', 'targetClass' => '\common\models\Employee',
                    'filter' => function ($query) {
                        if ($this->employee_id !== null)
                            $query->where([
                                'and',
                                ['!=', 'employee_id', $this->employee_id],
                                ['=', 'tin', $this->tin]
                            ]);
                        else
                            $query->where(['=', 'tin', $this->tin]);
                    },
                    'message' => 'Este nº de contribuinte já está a ser utilizado.'
                ],


                ['num_emp', 'required', 'message' => "É necessário o nº de empregado."],
                [
                    'num_emp', 'string',
                    'max' => 20, 'tooLong' => 'O nº de empregado não pode exceder os 20 caracteres.'
                ],
                [
                    'num_emp', 'unique', 'targetClass' => '\common\models\Employee',
                    'filter' => function ($query) {
                        if ($this->employee_id !== null)
                            $query->where([
                                'and',
                                ['!=', 'employee_id', $this->employee_id],
                                ['=', 'num_emp', $this->num_emp]
                            ]);
                        else
                            $query->where(['=', 'tin', $this->num_emp]);
                    },
                    'message' => 'Este nº de empregado já está a ser utilizado.'
                ],

                ['ssn', 'required', 'message' => "É necessário o nº de segurança social."],
                [
                    'ssn', 'string',
                    'max' => 20, 'tooLong' => "O nº de segurança social não pode exceder os 20 caracteres."
                ],
                [
                    'ssn', 'unique', 'targetClass' => '\common\models\Employee',
                    'filter' => function ($query) {
                        if ($this->employee_id !== null)
                            $query->where([
                                'and',
                                ['!=', 'employee_id', $this->employee_id],
                                ['=', 'ssn', $this->ssn]
                            ]);
                        else
                            $query->where(['=', 'ssn', $this->ssn]);
                    }, 'message' =>  'Este nº de segurança social já está a ser utilizado.'
                ],

                ['street', 'required', 'message' => "É necessário o nome da rua."],
                [
                    'street', 'string',
                    'max' => 100, 'tooLong' => "O nome da rua não pode exceder os 100 caracteres."
                ],

                ['zip_code', 'required', 'message' => "É necessário o código postal."],
                [
                    'zip_code', 'string',
                    'max' => 20, 'tooLong' => "O código postal não pode exceder os 20 caracteres."
                ],

                ['iban', 'required', 'message' => "É necessário o iban."],
                [
                    'iban', 'string',
                    'min' => 25, 'tooShort' => 'O iban tem de ter 25 caracteres.',
                    'max' => 25, 'tooLong' => 'O iban tem de ter 25 caracteres.'
                ],
                [
                    'iban', 'unique', 'targetClass' => '\common\models\Employee',
                    'filter' => function ($query) {
                        if ($this->employee_id !== null)
                            $query->where([
                                'and',
                                ['!=', 'employee_id', $this->employee_id],
                                ['=', 'iban', $this->iban]
                            ]);
                        else
                            $query->where(['=', 'iban', $this->iban]);
                    }, 'message' => 'Este iban já está a ser utilizado.'
                ],

                ['qualifications', 'required', 'message' => "É necessário a qualificação."],
                ['qualifications', 'in', 'range' => $this->possible_employee_qualifications, 'strict' => true, 'message' => 'Qualificação inválida.'],

                ['function_id', 'required', 'message' => "É necessário a função."],
                ['function_id', 'in', 'range' => $this->possible_employee_functions, 'message' => 'Função inválida']
            ];

        return ArrayHelper::merge($rules, $newRules);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();

        $newAttributeLabels =
            [
                // Employee
                'tin' => 'Nº Contribuinte',
                'num_emp' => 'Nº Empregado',
                'ssn' => 'Nº Segurança Social',
                'street' => 'Nome da rua',
                'zip_code' => 'Código Postal',
                'iban' => 'Iban',
                'qualifications' => 'Qualificações',
                'function_id' => 'Função'
            ];

        return ArrayHelper::merge($attributeLabels, $newAttributeLabels);
    }



    /**
     * Creates new employee
     * @return bool
     */
    public function create()
    {
        $transaction = Employee::getDb()->beginTransaction();
        try {

            // Creates new user
            if (!parent::create())
                return null;

            // Criar o employee
            $employee = new Employee();
            $employee->employee_id = $this->user_id;
            $employee->setAttributes($this->getEmployeeDetails(), false);

            if (!$employee->save())
                throw new ErrorException();


            $this->employee_id = $employee->employee_id;

            // Assign role to new employee
            $auth = Yii::$app->authManager;
            $employeeRole = $auth->getRole('employee');
            $auth->assign($employeeRole, $employee->employee_id);

            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            return null;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     * Updates employee
     * @return bool
     */
    public function update()
    {
        $transaction = Employee::getDb()->beginTransaction();
        try {
            // Updates user
            if (!parent::update())
                return null;


            // Updates employee
            $employee = $this->getEmployee();

            $employee->setAttributes($this->getEmployeeDetails(), false);
            if (!$employee->save())
                throw new ErrorException();

            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            return null;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return true;
    }


    /**
     * Setups employee on form if you have the ID
     *
     * @param int $id Employee ID
     */
    protected function setupEmployeeOnForm($employee_id)
    {
        $this->employee_id = $employee_id;
        $employee = $this->getEmployee();
        $this->setAttributes($employee->getAttributes());
    }

    /**
     * Setups the possible employee functions to this form
     *
     */
    protected function setupPossibleEmployeeFunctions()
    {

        $this->possible_employee_functions = EmployeeFunction::getPossibleEmployeeFunctionsIDs();
        $this->possible_employee_functions_for_dropdown = EmployeeFunction::getPossibleEmployeeFunctionsForDropdowns();
    }



    /**
     * Gets employee by [[employee_id]]
     *
     * @return Employee|null
     */
    protected function getEmployee()
    {
        if ($this->_employee === null) {
            $this->_employee = Employee::findOne($this->employee_id);
        }

        return $this->_employee;
    }


    /**
     * Gets all the employee details.
     * @return array
     */
    private function getEmployeeDetails()
    {
        return [
            'tin' => $this->tin,
            'num_emp' => $this->num_emp,
            'ssn' => $this->ssn,
            'street' => $this->street,
            'zip_code' => $this->zip_code,
            'iban' => $this->iban,
            'qualifications' => $this->qualifications,
            'function_id' => $this->function_id
        ];
    }
}
