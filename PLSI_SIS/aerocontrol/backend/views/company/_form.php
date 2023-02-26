<?php

use common\models\Company;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Company $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin([
        'validateOnType' => true,
        'validationDelay' => 500,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropDownList([Company::STATE_INACTIVE => 'Inativo', Company::STATE_ACTIVE => 'Ativo'], [
        'class' => 'form-control'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>