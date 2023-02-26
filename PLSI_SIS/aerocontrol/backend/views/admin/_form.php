<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Admin $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin([
        'id' => 'admin-form',
        'validateOnType' => true,
        'validationDelay' => 500,
    ]); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'phone_country_code')->textInput() ?>

    <?= $form->field($model, 'phone')->input('tel') ?>

    <?= $form->field($model, 'gender')->dropDownList($model->possible_genders_for_dropdown, [
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'country')->textInput() ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'birthdate')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
