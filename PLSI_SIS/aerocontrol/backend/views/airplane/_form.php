<?php

use common\models\Airplane;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Airplane $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="airplane-form">

    <?php $form = ActiveForm::begin([
        'validateOnType' => true,
        'validationDelay' => 500,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <?= $form->field($model, 'state')->dropDownList([Airplane::STATE_INACTIVE => 'Inativo', Airplane::STATE_ACTIVE => 'Ativo'], [
        'class' => 'form-control'
    ]) ?>

    <?= $form->field($model, 'company_id')->dropDownList($model->possible_airplane_companies_for_dropdown, [
        'class' => 'form-control',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>