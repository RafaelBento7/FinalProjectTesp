<?php

/** @var yii\web\View $this */
/** @var \common\models\FlightForm $model */
/** @var \common\models\Airport[] $airports */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->registerJsFile('@web/js/flight-search-form.js');
?>

<?php $form = ActiveForm::begin([
    'action' => ['search'],
    'errorCssClass' => 'invalid',
    'requiredCssClass' => 'invalid',
    'successCssClass' => 'valid',
    'validateOnType' => true,
    'validationDelay' => 500,
    'method' => 'get',
    'options' => [
        'class' => '[ flight-search-form ] [ box-shadow-1  flow border-radius-1 ]',
        'data-flow-space' => 'small',
    ]
]) ?>
<div class="even-columns gap-2">
    <?=
    $form->field($model, 'two_way_trip', [
        'errorOptions' => [
            'tag' => false,
        ]
    ])
        ->radioList(
            [
                '0' => 'Só Ida',
                '1' => 'Ida e Volta'
            ],
            [
                'item' => function ($index, $label, $name, $checked, $value) {

                    $return = '<label class="radio-button radio-button-pill button" data-type="primary-outline" data-active="' . ($checked ? "true" : "false") . '">';
                    $return .= '<input type="radio" class="visually-hidden" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : "") . ' ';
                    switch ($index) {
                            // Será o radio de 'Só Ida'
                        case 0:
                            // Se for o selecionado por defeito então adiciona o force-close
                            if ($checked)
                                $return .= 'data-force-close="true"';
                            $return .= 'data-close="#destiny_departure_date__wrapper"';
                            break;

                            // Será o radio de 'Ida e Volta'
                        case 1:


                            $return .= 'data-open="#destiny_departure_date__wrapper"';
                            break;
                    }

                    $return .= ">";
                    $return .= $label;
                    $return .= '</label>';

                    return $return;
                },
                'class' => '[ form__group ] [ flex-flow-row gap-2 justify-content-space-between-sm ]',
            ]
        )
        ->label(false);
    ?>
</div>

<datalist id="airports">
    <?php
    foreach ($airports as $airport) {
        echo '<option value=\'' . $airport->name . '\'>';
    }
    ?>
</datalist>

<div class="even-columns gap-2">
    <?= $form->field($model, 'origin', [
        'errorOptions' => [
            'tag' => 'p',
            'class' => 'input__error margin-top-50 '
        ],
        'options' => ['class' => 'form__group gap-0'],
    ])
        ->label(null, [
            'class' => '[ input__label ] [ margin-bottom-50 ]'
        ])
        ->textInput([
            'class' => 'form__input',
            'list' => 'airports',
        ]) ?>

    <?= $form->field($model, 'destiny', [
        'errorOptions' => [
            'tag' => 'p',
            'class' => 'input__error margin-top-50'
        ],
        'options' => ['class' => 'form__group gap-0'],
    ])
        ->label(null, [
            'class' => '[ input__label ] [ margin-bottom-50 ]'
        ])
        ->textInput([
            'class' => 'form__input',
            'list' => 'airports',
        ]) ?>
</div>

<div class="even-columns gap-1">
    <?= $form->field($model, 'origin_departure_date', [
        'errorOptions' => [
            'tag' => 'p',
            'class' => 'input__error margin-top-50'
        ],
        'options' => [
            'class' => 'form__group gap-0',
        ],
    ])
        ->label(null, [
            'class' => '[ input__label ] [ margin-bottom-50 ]'
        ])
        ->textInput([
            'class' => 'form__input',
            'type' => 'date'
        ]) ?>

    <?= $form->field($model, 'destiny_departure_date', [
        'errorOptions' => [
            'tag' => 'p',
            'class' => 'input__error margin-top-50'
        ],
        'options' => [
            'class' => 'form__group gap-0',
            'id' => 'destiny_departure_date__wrapper'
        ],
    ])
        ->label(null, [
            'class' => '[ input__label ] [ margin-bottom-50 ]'
        ])
        ->textInput([
            'class' => 'form__input',
            'type' => 'date'
        ]) ?>

    <?= $form->field($model, 'passengers', [
        'errorOptions' => [
            'tag' => 'p',
            'class' => 'input__error margin-top-50'
        ],
        'options' => ['class' => 'form__group gap-0'],
    ])
        ->label(null, [
            'class' => '[ input__label ] [ margin-bottom-50 ]'
        ])
        ->textInput([
            'class' => 'form__input',
            'type' => 'number',
            'value' => ($model->passengers === null) ? 1 : $model->passengers,
        ]) ?>
</div>

<?= Html::submitButton('Pesquisar', ['class' => '[ form__submit-button button ] [ fill-sm  d-block push-to-right ]']) ?>
<?php ActiveForm::end(); ?>