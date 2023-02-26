<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Suporte';
?>
<div class="padding-block-700 height-100 d-grid align-items-center">
    <div class="container" data-type="small-md">
        <h1 class="fs-600 fw-bold text-align-center">Contactar Suporte</h1>
        <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
            'errorCssClass' => 'invalid',
            'requiredCssClass' => 'invalid',
            'successCssClass' => 'valid',
            'validateOnType' => true,
            'validationDelay' => 500,
            'options' => [
                'class' => 'margin-top-400 flow',
                'data-flow-space' => 'large',
            ]
        ]) ?>
        <div class="flow" data-flow-space="small">

            <?= $form->field($model, 'name', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50'
                ],
                'options' => ['class' => 'form__group'],
            ])
                ->label(null, [
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->textInput([
                    'class' => 'form__input',
                ]) ?>


            <?= $form->field($model, 'email', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50 '
                ],
                'options' => ['class' => 'form__group'],
            ])
                ->label(null, [
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->textInput([
                    'class' => 'form__input',
                    'type' => 'email'
                ]) ?>


            <?= $form->field($model, 'body', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50 '
                ],
                'options' => ['class' => 'form__group'],
            ])
                ->label(null, [
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->textarea([
                    'class' => 'form__input resize-none',
                    'rows' => 12
                ]) ?>
        </div>

        <?= Html::submitButton('Enviar', [
            'class' => 'form__submit-button button fill-sm d-block push-to-right-md',
            'data-size' => 'large-md',
        ]) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>