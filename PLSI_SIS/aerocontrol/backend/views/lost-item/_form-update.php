<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\LostItem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="lost-item-form">

    <?php $form = ActiveForm::begin([
        'validateOnType' => true,
        'validationDelay' => 500,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'state')->dropDownList($model->POSSIBLE_STATES_FOR_DROPDOWN, [
        'class' => 'form-control',
        'custom' => true
    ]) ?>

    <?php
    if (!is_null($model->image)) {
        echo $form->field($model, 'imageFile')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview' => Url::to($model->getImagePathUrl()),
                'initialPreviewAsData' => true,
                'initialCaption' => $model->image,
                'initialPreviewConfig' => [
                    [
                        'caption' => $model->image,
                    ],
                ],
                'showCancel' => false,
                'showUpload' => false,
                'showRemove' => false,
            ]
        ]);
    } else {
        echo $form->field($model, 'imageFile')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showCancel' => false,
                'showUpload' => false,
            ]
        ]);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>