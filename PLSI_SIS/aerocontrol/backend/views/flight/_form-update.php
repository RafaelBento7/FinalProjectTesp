<?php

use yii\helpers\Html;
use common\models\Flight;
use kartik\form\ActiveForm;
use kartik\datetime\DateTimePicker;


/** @var yii\web\View $this */
/** @var common\models\Flight $model */
/** @var kartik\form\ActiveForm; $form */
?>

<div class="flight-form">

    <?php $form = ActiveForm::begin([
        'validateOnType' => true,
        'validationDelay' => 500,
    ]); ?>

    <?= $form->field($model, 'terminal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estimated_departure_date')->widget(DateTimePicker::classname(), [
        'options' => [
            'class' => 'form-control'
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy hh:ii'
        ]
    ]) ?>

    <?= $form->field($model, 'estimated_arrival_date')->widget(DateTimePicker::classname(), [
        'options' => [
            'class' => 'form-control'
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy hh:ii'
        ]
    ]) ?>

    <?= $form->field($model, 'departure_date')->widget(DateTimePicker::classname(), [
        'options' => [
            'class' => 'form-control'
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy hh:ii'
        ]
    ]) ?>

    <?= $form->field($model, 'arrival_date')->widget(DateTimePicker::classname(), [
        'options' => [
            'class' => 'form-control'
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy hh:ii'
        ]
    ]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'distance')->textInput() ?>

    <?= $form->field($model, 'state')->dropDownList(Flight::POSSIBLE_STATES_FOR_DROPDOWN, ['custom' => true, 'class' => 'form-control']) ?>

    <?= $form->field($model, 'discount_percentage')->textInput() ?>

    <?= $form->field($model, 'origin_airport_id')->dropDownList($model->possible_flight_airports_for_dropdown, [
        'custom' => true,
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'arrival_airport_id')->dropDownList($model->possible_flight_airports_for_dropdown, [
        'custom' => true,
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'airplane_id')->dropDownList($model->possible_flight_airplanes_for_dropdown, [
        'custom' => true,
        'class' => 'form-control',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>