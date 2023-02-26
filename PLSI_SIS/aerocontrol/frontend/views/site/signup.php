<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\SignupForm $model */

use common\models\User;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Sign Up';
?>

<div class="padding-block-700 height-100 d-grid align-items-center">
    <div class="container" data-type="small-md">
        <div class="text-align-center flow" data-flow-space="small">
            <h1 class="fs-600 fw-bold text-align-center">Criar conta</h1>
            <p>Crie a sua conta para começar a reservar voos e muito mais.</p>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'signup-form',
            'errorCssClass' => 'invalid',
            'requiredCssClass' => 'invalid',
            'successCssClass' => 'valid',
            'validateOnType' => true,
            'validationDelay' => 500,
            'options' => [
                'class' => '[ form ] [ margin-top-600 flow ]',
                'data-flow-space' => 'large'
            ]
        ]) ?>

        <div>
            <h2 class="fs-500 fw-semi-bold text-align-center-sm">Dados de acesso</h2>
            <div class="even-columns gap-2-sm gap-1-md margin-top-200">

                <?= $form->field($model, 'username', [
                    'errorOptions' => [
                        'tag' => 'p',
                        'class' => 'input__error margin-top-50'
                    ],
                    'options' => ['class' => 'form__group'],
                ])
                    ->label("Username:", [
                        'class' => '[ input__label ] [ margin-bottom-50 ]'
                    ])
                    ->textInput([
                        'class' => 'form__input'
                    ]) ?>


                <?= $form->field($model, 'password_hash', [
                    'options' => ['class' => 'form__group'],
                    'errorOptions' => [
                        'tag' => 'p',
                        'class' => 'input__error margin-top-50'
                    ],
                ])
                    ->label("Password:", [
                        'class' => '[ input__label ] [ margin-bottom-50 ]'
                    ])
                    ->passwordInput(['class' => 'form__input']) ?>

            </div>
        </div>

        <div>
            <h2 class="fs-500 fw-semi-bold text-align-center-sm">Dados pessoais</h2>
            <div class="flow margin-top-200">
                <div class="even-columns gap-2-sm gap-1-md">

                    <?= $form->field($model, 'first_name', [
                        'errorOptions' => [
                            'tag' => 'p',
                            'class' => 'input__error margin-top-50'
                        ],
                        'options' => ['class' => 'form__group'],
                    ])
                        ->label("Primeiro Nome:", [
                            'class' => '[ input__label ] [ margin-bottom-50 ]'
                        ])
                        ->textInput([
                            'class' => 'form__input'
                        ]) ?>



                    <?= $form->field($model, 'last_name', [
                        'errorOptions' => [
                            'tag' => 'p',
                            'class' => 'input__error margin-top-50'
                        ],
                        'options' => ['class' => 'form__group'],
                    ])
                        ->label("Último nome:", [
                            'class' => '[ input__label ] [ margin-bottom-50 ]'
                        ])
                        ->textInput([
                            'class' => 'form__input'
                        ]) ?>


                    <?= $form->field($model, 'gender', [
                        'errorOptions' => [
                            'tag' => 'p',
                            'class' => 'input__error margin-top-50'
                        ],
                        'options' => ['class' => 'form__group'],
                    ])
                        ->label("Género:", [
                            'class' => '[ input__label ] [ margin-bottom-50 ]'
                        ])
                        ->dropDownList($model->possible_genders_for_dropdown, [
                            'prompt' => '',
                            'class' => 'form__input'
                        ]) ?>

                </div>
                <div class="d-flex flex-flow-column-sm gap-2">

                    <?= $form->field($model, 'birthdate', [
                        'errorOptions' => [
                            'tag' => 'p',
                            'class' => 'input__error margin-top-50'
                        ],
                        'options' => ['class' => 'form__group'],
                    ])
                        ->label("Data de Nascimento:", [
                            'class' => '[ input__label ] [ margin-bottom-50 ]'
                        ])
                        ->input('date', [
                            'class' => 'form__input'
                        ]) ?>

                    <?= $form->field($model, 'country', [
                        'errorOptions' => [
                            'tag' => 'p',
                            'class' => 'input__error margin-top-50'
                        ],
                        'options' => ['class' => 'form__group'],
                    ])
                        ->label("País:", [
                            'class' => '[ input__label ] [ margin-bottom-50 ]'
                        ])
                        ->textInput([
                            'class' => 'form__input'
                        ]) ?>

                    <?= $form->field($model, 'city', [
                        'errorOptions' => [
                            'tag' => 'p',
                            'class' => 'input__error margin-top-50'
                        ],
                        'options' => ['class' => 'form__group'],
                    ])
                        ->label("Cidade:", [
                            'class' => '[ input__label ] [ margin-bottom-50 ]'
                        ])
                        ->textInput([
                            'class' => 'form__input'
                        ]) ?>
                </div>
            </div>
        </div>

        <div>
            <h2 class="fs-500 fw-semi-bold text-align-center-sm">Contactos</h2>
            <div class="d-flex flex-flow-column-sm margin-top-200">

                <?= $form->field($model, 'email', [
                    'errorOptions' => [
                        'tag' => 'p',
                        'class' => 'input__error margin-top-50'
                    ],
                    'options' => ['class' => '[ form__group ] [ flex-1 ]'],
                ])
                    ->label("Email:", [
                        'class' => '[ input__label ] [ margin-bottom-50 ]'
                    ])
                    ->textInput([
                        'class' => 'form__input'
                    ]) ?>


                <div class="form__group flex-1">
                    <label class="[ input__label ] [ margin-bottom-50 ]">Contacto telefónico:</label>
                    <div class="d-flex width-100">

                        <?= $form->field($model, 'phone_country_code', [
                            'errorOptions' => [
                                'tag' => 'p',
                                'class' => 'input__error margin-top-50'
                            ],
                            'template' => '{input}{error}',
                            'options' => ['class' => 'flex-1'],
                        ])
                            ->textInput([
                                'placeholder' => 'indicativo',
                                'class' => 'form__input'
                            ]) ?>



                        <?= $form->field($model, 'phone', [
                            'errorOptions' => [
                                'tag' => 'p',
                                'class' => 'input__error margin-top-50'
                            ],
                            'template' => '{input}{error}',
                            'options' => ['class' => 'flex-2'],
                        ])
                            ->Input('tel', [
                                'placeholder' => 'nº de telemóvel',
                                'class' => 'form__input'
                            ]) ?>


                    </div>
                </div>
            </div>
        </div>


        <?= Html::submitButton('Criar conta', [
            'class' => 'form__submit-button button fill-sm d-block push-to-center-md',
            'data-size' => "large-md"
        ]) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>