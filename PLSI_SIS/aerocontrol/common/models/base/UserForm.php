<?php

namespace common\models\base;

use common\models\User;
use yii\base\Model;
use Yii;

class UserForm extends Model
{
    private $possible_genders = User::POSSIBLE_GENDERS;
    public $possible_genders_for_dropdown = User::POSSIBLE_GENDERS_FOR_DROPDOWN;

    // User
    public $user_id;
    public $username;
    public $email;
    public $password_hash;
    public $first_name;
    public $last_name;
    public $gender;
    public $country;
    public $city;
    public $birthdate;
    public $phone;
    public $phone_country_code;

    protected $_user;       // Variável que recebe os dados do user da BD

    public function __construct($user_id = null, $config = [])
    {
        // Se existir um user_id então dá setup do correspondente User com este form
        if ($user_id !== null) {
            $this->setupUserOnForm($user_id);
        }

        parent::__construct($config);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // User   
            ['username', 'trim'],
            ['username', 'required', 'message' => "É necessário um username."],
            [
                'username', 'string',
                'min' => 2, 'tooShort' => 'A username deve conter pelo menos 2 caracteres.',
                'max' => 30, 'tooLong' => 'A username não pode exceder os 30 caracteres.'
            ],
            [
                'username', 'unique',
                'targetClass' => 'common\models\User',
                'filter' => function ($query) {
                    if ($this->user_id !== null)
                        $query->where([
                            'and',
                            ['!=', 'id', $this->user_id],
                            ['=', 'username', $this->username]
                        ]);
                    else
                        $query->where(['=', 'username', $this->username]);
                },
                'message' => 'Este username já está a ser utilizado.'
            ],

            ['email', 'trim'],
            ['email', 'required', 'message' => "É necessário um email."],
            ['email', 'email', 'message' => "Email inválido."],

            ['password_hash', 'trim'],
            ['password_hash', 'required', 'message' => "É necessário uma password."],
            ['password_hash', 'string', 'min' => Yii::$app->params['user.passwordMinLength'], 'tooShort' => "A password deve conter pelo menos " . Yii::$app->params['user.passwordMinLength'] . " caracteres."],

            ['first_name', 'trim'],
            ['first_name', 'required', 'message' => "É necessário o primeiro nome."],
            [
                'first_name', 'string',
                'max' => 50, 'tooLong' => 'O primeiro nome não pode exceder os 50 caracteres.'
            ],

            ['last_name', 'trim'],
            ['last_name', 'required', 'message' => "É necessário o último nome."],
            [
                'last_name', 'string',
                'max' => 50, 'tooLong' => 'O último nome não pode exceder os 50 caracteres.'
            ],

            ['gender', 'required', 'message' => "É necessário o género."],
            ['gender', 'in', 'range' => $this->possible_genders, 'strict' => true],

            ['country', 'trim'],
            ['country', 'required', 'message' => "É necessário o país."],
            [
                'country', 'string',
                'min' => 4, 'tooShort' => 'O nome do país deve conter pelo menos 4 caracteres.',
                'max' => 50, 'tooLong' => 'O nome do país não pode exceder os 50 caracteres.'
            ],

            ['city', 'trim'],
            ['city', 'required', 'message' => "É necessário a cidade."],
            [
                'city', 'string',
                'min' => 1, 'tooShort' => 'O nome da cidade deve conter pelo menos 1 caractere.',
                'max' => 75, 'tooLong' => 'O nome da cidade não pode exceder os 75 caracteres.'
            ],

            ['birthdate', 'required', 'message' => "É necessária a data de nascimento."],
            ['birthdate', 'date', 'format' => 'yyyy-MM-dd'],

            ['phone_country_code', 'trim'],
            ['phone_country_code', 'required', 'message' => "É necessário o indicativo do nº de telemóvel."],
            ['phone_country_code', 'match', 'pattern' => '/\+[\d]{1,4}$/', 'message' => "Formato inválido.\nExemplo: +000"],

            ['phone', 'trim'],
            ['phone', 'required', 'message' => "É necessário o nº de telemóvel."],
            [
                'phone', 'number',
                'numberPattern' => '/[\d]{4,15}$/', 'message' => "O nº de telemóvel só pode conter números, ter pelo menos 4 números e não pode exceder os 15 números.",
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // User
            'username' => 'Username',
            'password_hash' => 'Password',
            'first_name' => 'Primeiro nome',
            'last_name' => 'Último nome',
            'gender' => 'Género',
            'country' => 'País',
            'city' => 'Cidade',
            'birthdate' => 'Data de Nascimento',
            'email' => 'Email',
            'phone' => 'Nº Telemóvel',
            'phone_country_code' => 'Indicativo do país',
            'status' => 'Estado'
        ];
    }


    /**
     * Resets choosen attributes on invalid
     */
    public function resetAttributesOnInvalid()
    {
        $this->password_hash = '';
    }

    /**
     * Creates new user
     * @return bool
     */

    protected function create()
    {
        if (!$this->validate())
            return null;

        $user = new User();
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->setAttributes($this->getUserDetails(), false);
        $user->setPassword($user->password_hash);
        if (!$user->save())
            return null;

        $this->user_id = $user->id;
        return true;
    }

    /**
     * Updates user
     * @return bool
     */
    protected function update()
    {
        if (!$this->validate())
            return null;

        $user = $this->getUser();
        $user->setAttributes($this->getUserDetails(), false);

        if ($this->_user->password_hash !== $user->password_hash) {
            $user->setPassword($this->password_hash);
        }

        if (!$user->save())
            return null;

        return true;
    }


    /**
     * Setups user on form if you have the [[user_id]]
     *
     * @param int $user_id User ID
     */
    protected function setupUserOnForm($user_id)
    {
        $this->user_id = $user_id;
        $user = $this->getUser();
        $this->setAttributes($user->getAttributes());
    }

    /**
     * Finds user by [[user_id]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findOne($this->user_id);
        }
        return clone ($this->_user);
    }

    /**
     * Gets all the user details.
     * @return array
     */
    protected function getUserDetails()
    {
        return [
            'password_hash' => $this->password_hash,
            'username' => $this->username,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'country' => $this->country,
            'city' => $this->city,
            'birthdate' => $this->birthdate,
            'phone' => $this->phone,
            'phone_country_code' => $this->phone_country_code,
            'password_reset_token' => null,
        ];
    }
}
