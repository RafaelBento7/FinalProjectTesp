<?php

namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $new_password;
    public $new_password_repeat;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['new_password', 'new_password_repeat'], 'trim'],
            [['new_password', 'new_password_repeat'], 'required', 'message' => 'A password não pode ser vazia.'],
            [
                'new_password', 'string',
                'min' => Yii::$app->params['user.passwordMinLength'],
                'tooShort' => 'A password tem de conter no mínimo ' . Yii::$app->params['user.passwordMinLength'] . ' caracteres.'
            ],
            ['new_password_repeat', 'compare', 'compareAttribute' => 'new_password', 'message' => 'Esta password não é igual à inserida anteriormente.']
        ];
    }

    public function attributeLabels()
    {
        return [
            'new_password' => 'Nova Password',
            'new_password_repeat' => 'Confirmar Password'
        ];
    }


    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->new_password);
        $user->removePasswordResetToken();
        $user->generateAuthKey();

        return $user->save(false);
    }
}
