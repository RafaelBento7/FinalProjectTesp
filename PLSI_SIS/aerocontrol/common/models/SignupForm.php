<?php

namespace common\models;

use common\models\ClientForm;
use Yii;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends ClientForm
{

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!parent::create())
            return false;

        $this->sendEmail($this->getUser());

        return true;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' support'])
            ->setTo($this->email)
            ->setSubject('Registo de conta ' . Yii::$app->name)
            ->send();
    }
}
