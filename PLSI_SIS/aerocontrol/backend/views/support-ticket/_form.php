<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TicketMessageForm $model */
/** @var yii\widgets\ActiveForm $form */
/** @var int $ticket_id */

?>

<div class="support-ticket-form">

    <?php $form = ActiveForm::begin([
        'action' => ['view', 'ticket_id' => $ticket_id],
        'validateOnType' => true,
        'validationDelay' => 500,
        'options' => [
            'class' => 'd-flex justify-content-start align-items-center'
        ]
    ]); ?>


    <?= $form->field($model, 'message', [
        'options' => [
            'class' => 'w-100 mr-2'
        ]
    ])->textInput([
        'class' => 'form-control'
    ])->label(false) ?>

    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary align-self-start']) ?>


    <?php ActiveForm::end(); ?>

</div>