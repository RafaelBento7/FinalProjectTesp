<?php

/** @var \common\models\SupportTicketForm $model */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

?>

<div class="support-ticket-form">

    <?php $form = ActiveForm::begin([
        'id' => 'support-ticket',
        'action' => ['create'],
        'errorCssClass' => 'invalid',
        'requiredCssClass' => 'invalid',
        'successCssClass' => 'valid',
        'validateOnType' => true,
        'validationDelay' => 500,
    ]); ?>

    <p class="fs-400 fw-medium ">Criar um novo ticket!</p>

    <div class="flow margin-top-300" data-flow-space="small">

        <?= $form->field($model, 'title', [
            'errorOptions' => [
                'tag' => 'p',
                'class' => 'input__error margin-top-50'
            ],
            'options' => ['class' => 'form__group'],
        ])
            ->label(null, [
                'class' => '[ input__label ] [ fw-light margin-bottom-50 ]'
            ])
            ->textInput([
                'class' => 'form__input'
            ]) ?>

        <?= $form->field($model, 'message', [
            'errorOptions' => [
                'tag' => 'p',
                'class' => 'input__error margin-top-50'
            ],
            'options' => ['class' => 'form__group'],
        ])
            ->label(null, [
                'class' => '[ input__label ] [ fw-light margin-bottom-50 ]'
            ])
            ->textArea([
                'class' => 'form__input resize-none',
                'rows' => 7
            ]) ?>

    </div>
    <?= Html::submitButton('Guardar', ['class' => '[ button ] [ d-block fill-sm margin-top-300 push-to-right-md ]']) ?>

    <?php ActiveForm::end(); ?>
</div>