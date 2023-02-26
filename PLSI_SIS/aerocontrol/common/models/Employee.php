<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $employee_id
 * @property string $tin
 * @property string $num_emp
 * @property string $ssn
 * @property string $street
 * @property string $zip_code
 * @property string $iban
 * @property string $qualifications
 * @property int $function_id
 *
 * @property User $user
 * @property EmployeeFunction $function
 * @property SupportTicket[] $supportTickets
 */
class Employee extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const POSSIBLE_QUALIFICATIONS = [
        'Até ao 9º ano de escolaridade',
        'Secundário',
        'Curso técnico superior profissional',
        'Diploma de Especialização Tecnológica',
        'Ensino superior - bacharelato ou equivalente',
        'Licenciatura Pré-Bolonha',
        'Licenciatura 1º Ciclo - Pós-Bolonha',
        'Mestrado',
        'Doutoramento'
    ];

    const POSSIBLE_QUALIFICATIONS_FOR_DROPDOWN = [

        'Até ao 9º ano de escolaridade' => 'Até ao 9º ano de escolaridade',
        'Secundário' => 'Secundário',
        'Curso técnico superior profissional' => 'Curso técnico superior profissional',
        'Diploma de Especialização Tecnológica' => 'Diploma de Especialização Tecnológica',
        'Ensino superior - bacharelato ou equivalente' => 'Ensino superior - bacharelato ou equivalente',
        'Licenciatura Pré-Bolonha' => 'Licenciatura Pré-Bolonha',
        'Licenciatura 1º Ciclo - Pós-Bolonha' => 'Licenciatura 1º Ciclo - Pós-Bolonha',
        'Mestrado' => 'Mestrado',
        'Doutoramento' => 'Doutoramento'
    ];


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%employee}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['qualifications', 'in', 'range' => self::POSSIBLE_QUALIFICATIONS, 'strict' => true],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'ID do Empregado',
            'tin' => 'Nº Contribuinte',
            'num_emp' => 'Nº Empregado',
            'ssn' => 'Nº Segurança Social',
            'street' => 'Nome da rua',
            'zip_code' => 'Código Postal',
            'iban' => 'Iban',
            'qualifications' => 'Qualificações',
            'function_id' => 'ID da Função',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'employee_id']);
    }

    /**
     * Gets query for [[Function]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFunction()
    {
        return $this->hasOne(EmployeeFunction::class, ['id' => 'function_id']);
    }

    /**
     * Gets query for [[SupportTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTickets()
    {
        return $this->hasMany(SupportTicket::class, ['employee_id' => 'employee_id']);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $employee_id = Yii::$app->request->get("employee_id");
        User::findOne($employee_id)->delete();
    }
}
