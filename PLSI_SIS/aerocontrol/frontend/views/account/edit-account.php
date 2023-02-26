<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\ClientForm $model*/

$this->title = 'Login';

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>
<div class="padding-block-700 height-100 d-grid align-items-center">
    <div class="container" data-type="small-md">
        <h1 class="fs-600 fw-bold text-align-center">Editar dados da conta</h1>

        <?php
        $form = ActiveForm::begin([
            'id' => 'login-form',
            'errorCssClass' => 'invalid',
            'requiredCssClass' => 'invalid',
            'successCssClass' => 'valid',
            'validateOnType' => true,
            'validationDelay' => 500,
            'options' => [
                'class' => '[ form ] [ margin-top-600 flow ]',
                'data-flow-space' => 'large'
            ]
        ])
        ?>
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
                        ->label(null, [
                            'class' => '[ input__label ] [ margin-bottom-50 ]'
                        ])
                        ->textInput([
                            'class' => 'form__input'
                        ]) ?>

                    <?= $form->field($model, 'password_hash', [
                        'errorOptions' => [
                            'tag' => 'p',
                            'class' => 'input__error margin-top-50'
                        ],
                        'options' => ['class' => 'form__group'],
                    ])
                        ->label(null, [
                            'class' => '[ input__label ] [ margin-bottom-50 ]'
                        ])
                        ->textInput([
                            'type' => 'password',
                            'class' => 'form__input'
                        ]) ?>
                </div>
            </div>

            <div>
                <h2 class="fs-500 fw-semi-bold text-align-center-sm">Dados pessoais</h2>
                <div class="flow margin-top-200">
                    <div class="even-columns gap-2-sm gap-1-md ">
                        <?= $form->field($model, 'first_name', [
                            'errorOptions' => [
                                'tag' => 'p',
                                'class' => 'input__error margin-top-50'
                            ],
                            'options' => ['class' => 'form__group'],
                        ])
                            ->label(null, [
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
                            ->label(null, [
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
                            ->label(null, [
                                'class' => '[ input__label ] [ margin-bottom-50 ]'
                            ])
                            ->dropDownList($model->possible_genders_for_dropdown,[
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
                            ->label(null, [
                                'class' => '[ input__label ] [ margin-bottom-50 ]'
                            ])
                            ->textInput([
                                'class' => 'form__input',
                                'type' => 'date'
                            ]) ?>

                        <?= $form->field($model, 'country', [
                            'errorOptions' => [
                                'tag' => 'p',
                                'class' => 'input__error margin-top-50'
                            ],
                            'options' => ['class' => 'form__group'],
                        ])
                            ->label(null, [
                                'class' => '[ input__label ] [ margin-bottom-50 ]'
                            ])
                            ->textInput([
                                'class' => 'form__input min-width-initial'
                            ]) ?>

                        <?= $form->field($model, 'city', [
                            'errorOptions' => [
                                'tag' => 'p',
                                'class' => 'input__error margin-top-50'
                            ],
                            'options' => ['class' => 'form__group'],
                        ])
                            ->label(null, [
                                'class' => '[ input__label ] [ margin-bottom-50 ]'
                            ])
                            ->textInput([
                                'class' => 'form__input min-width-initial'
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
                        'options' => ['class' => 'form__group flex-1'],
                    ])
                        ->label(null, [
                            'class' => '[ input__label ] [ margin-bottom-50 ]'
                        ])
                        ->textInput([
                            'type' => 'email',
                            'class' => 'form__input min-width-initial'
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
        <?= Html::submitButton('Guardar', [
            'class' => 'form__submit-button button fill-sm d-block push-to-right-md',
            'data-size' => 'large-md'
        ]) ?>
            <?php ActiveForm::end(); ?>
    </div>
</div>