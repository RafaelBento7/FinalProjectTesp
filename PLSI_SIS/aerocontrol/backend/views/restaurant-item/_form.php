<?php

use common\models\RestaurantItem;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\RestaurantItem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="restaurant-item-form">

    <?php $form = ActiveForm::begin([
        'validateOnType' => true,
        'validationDelay' => 500,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'item')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showCancel' => false,
            'showUpload' => false,
        ]
    ]) ?>

    <?= $form->field($model, 'state')->dropDownList([RestaurantItem::STATE_INACTIVE => 'Inativo', RestaurantItem::STATE_ACTIVE => 'Ativo'], [
        'class' => 'form-control'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
