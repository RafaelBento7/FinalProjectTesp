<?php

use common\models\LoginForm;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var LoginForm $model */

$this->title = 'Login';
?>
<div class="padding-block-700 height-100 d-grid align-items-center">
    <div class="container" data-type="extra-small-md">
        <h1 class="fs-600 fw-bold text-align-center">Login</h1>


        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'errorCssClass' => 'invalid',
            'requiredCssClass' => 'invalid',
            'successCssClass' => 'valid',
            'validateOnType' => true,
            'validationDelay' => 500,
            'options' => [
                'class' => '[ form ] [ margin-top-600 flow ]',
                'data-flow-space' => 'large'
            ]
        ]) ?>

        <div class="flow">
            <?= $form->field($model, 'username', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50'
                ],
                'options' => ['class' => 'form__group'],
            ])
                ->label("Username:", [
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->textInput([
                    'class' => 'form__input'
                ]) ?>




            <?= $form->field($model, 'password', [
                'options' => ['class' => 'form__group'],
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50'
                ],
            ])
                ->label("Password:", [
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->passwordInput(['class' => 'form__input']) ?>

            <?= $form->field($model, 'rememberMe', [
                'options' => ['class' => 'd-flex gap-1 align-items-center']
            ])
                ->checkbox([
                    'template' => '{input}{label}',
                    'uncheck' => null,
                    'label' => '<label for="loginform-rememberme" class="fs-200 letter-spacing-2">Guardar sessão</label>'
                ]) ?>
        </div>

        <div class="d-flex gap-1 flex-flow-column-sm justify-content-space-between-md">
            <?= Html::a('Esqueceu-se da password?', ['site/request-password-reset'], ['class' => 'fs-200 letter-spacing-2']) ?>
            <?= Html::a('Não possui uma conta?', ['site/signup'], ['class' => 'fs-200 letter-spacing-2']) ?>

        </div>

        <?= Html::submitButton('Login', [
            'class' => 'form__submit-button button fill-sm d-block push-to-center-md',
            'data-size' => 'large-md'
        ]) ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>