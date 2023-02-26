<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\time\TimePicker;

/** @var yii\web\View $this */
/** @var common\models\Store $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="store-form">

    <?php $form = ActiveForm::begin([
        'validateOnType' => true,
        'validationDelay' => 500,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'open_time')->widget(TimePicker::className(), [
        'pluginOptions' => [
            'showMeridian' => false,
            'minuteStep' => 1,
        ]
    ]) ?>

    <?= $form->field($model, 'close_time')->widget(TimePicker::className(), [
        'pluginOptions' => [
            'showMeridian' => false,
            'minuteStep' => 1,
        ]
    ]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>


    <?php
    if (!is_null($model->logo)) {
        echo $form->field($model, 'logoFile')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview' => Url::to($model->getLogoPathUrl()),
                'initialPreviewAsData' => true,
                'initialCaption' => $model->logo,
                'initialPreviewConfig' => [
                    [
                        'caption' => $model->logo,
                    ],
                ],
                'showCancel' => false,
                'showUpload' => false,
                'showRemove' => false,
            ]
        ]);
    } else {
        echo $form->field($model, 'logoFile')->widget(FileInput::classname(), [
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