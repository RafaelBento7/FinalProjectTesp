<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Employee $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin([
        'id' => 'employee-form',
        'validateOnType' => true,
        'validationDelay' => 500,
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_emp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'phone_country_code')->textInput() ?>

    <?= $form->field($model, 'phone')->input('tel') ?>

    <?= $form->field($model, 'gender')->dropDownList($model->possible_genders_for_dropdown, [
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'tin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ssn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iban')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qualifications')->dropDownList($model->possible_employee_qualifications_for_dropdown, [
        'prompt' => '',
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'function_id')->dropDownList($model->possible_employee_functions_for_dropdown, [
        'prompt' => '',
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'country')->textInput() ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthdate')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>