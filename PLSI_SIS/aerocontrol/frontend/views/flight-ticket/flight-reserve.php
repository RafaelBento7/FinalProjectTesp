<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \common\models\FlightReserveForm $model */
/** @var int $numPassengers */
/** @var int $flightBackId */
/** @var int $flightGoId */

use common\models\PaymentMethod;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Reservar Voo";
$this->registerJsFile('@web/js/flight-reserve.js');
?>
<section class="padding-block-700">
    <div class="container" data-type="small-md">
        <?php $form = ActiveForm::begin([
            'action' => [
                'create',
                'FlightForm[passengers]' => $numPassengers,
                'flightBackId' => $flightBackId,
                'flightGoId' => $flightGoId,
            ],
            'errorCssClass' => 'invalid',
            'requiredCssClass' => 'invalid',
            'successCssClass' => 'valid',
            'validateOnType' => true,
            'validationDelay' => 500,
        ]) ?>
        <section>
            <h1 class="fs-600 fw-bold text-align-center">Informações dos Passageiros</h1>
            <ul role="list" class="padding-300 box-shadow-1 margin-top-400 flow ]" data-flow-space="medium">
                <?php for ($i = 0; $i < $numPassengers; $i++) : ?>
                    <li class="[ flight-reserve__passenger-info ] [ d-grid gap-2 ]">


                        <?= $form->field($model, 'name[' . $i . ']', [
                            'template' => '<p class="fs-350 fw-medium grid-area-title align-self-center">Passageiro ' . ($i + 1) . '</p>{label}{input}{hint}{error}',
                            'options' => [
                                'class' => '[ form__group passenger-info__name ] [ d-grid row-gap-0 col-gap-2 ]',
                            ],
                            'errorOptions' => [
                                'tag' => 'p',
                                'class' => 'input__error grid-area-error-1 margin-top-50 text-break'
                            ],
                        ])
                            ->label(null, [
                                'class' => '[ input__label ] [ grid-area-label-1 margin-bottom-50 ' . ($i != 0 ? ' visually-hidden-flight-reserve' : ' ') . ' ]'
                            ])
                            ->textInput([
                                'class' => '[ form__input ] [ grid-area-input-1 ]',
                            ]) ?>


                        <div class="[ form__group passenger-info__gender-baggage ] [ d-grid row-gap-0 grid-area-form-group-1 ]">
                            <?= $form->field($model, 'gender[' . $i . ']', [
                                'errorOptions' => [
                                    'tag' => 'p',
                                    'class' => 'input__error grid-area-error-1 margin-top-50 text-break'
                                ],
                                'options' => ['tag' => false],
                            ])
                                ->label(null, [
                                    'class' => '[ input__label ] [ grid-area-label-1 margin-bottom-50' . ($i != 0 ? ' visually-hidden-flight-reserve' : ' ') . ' ]',
                                ])
                                ->dropDownList($model::POSSIBLE_GENDERS_FOR_DROPDOWN, [
                                    'prompt' => '',
                                    'class' => '[ form__input ] [ grid-area-select-1 ]'
                                ]) ?>

                            <?= $form->field($model, 'extra_baggage[' . $i . ']', [
                                'options' => [
                                    'class' => '[ form__group ] [ grid-area-form-group-1 align-items-center ]',
                                ],
                                'errorOptions' => [
                                    'tag' => false,
                                ]
                            ])->checkbox([
                                'template' => '
                                        <label for="extra-baggage" class="[ input__label ] [ margin-bottom-50 ' . ($i != 0 ? 'visually-hidden-flight-reserve' : ' ') . ' ]">{label}</label>
                                        <div class="d-flex height-100">{input}</div>{error}{hint}',
                                'class' => '[ form__input ] [ justify-self-center ]',
                            ]) ?>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </section>
        <section class="margin-top-500 flow" data-flow-space="large">
            <h2 class="fs-600 fw-bold text-align-center">Pagamento</h2>
            <?= $form->field($model, 'payment_method', [
                'errorOptions' => [
                    'tag' => false,
                ]
            ])
                ->radioList(
                    [
                        $model::CREDIT_CARD => 'Cartão de crédito',
                        $model::DEBIT_CARD => 'Cartão de débito',
                        $model::MBWAY => 'MBWay',
                        $model::MULTIBANCO => 'Multibanco',
                        $model::PAYPAL => 'Paypal'
                    ],
                    [
                        'item' => function ($index, $label, $name, $checked, $value) use ($model) {

                            $paymentMethod = PaymentMethod::find()->where(['name' => $label])->one();
                            $return = '<label class="[ payment-method-button ] [ radio-button button ' . (!$paymentMethod->state ? 'disabled' : '') . ' ]" 
                                    data-active="' . ($checked ? 'true" ' : 'false" ') . (!$paymentMethod->state ?
                                'data-toggle="tooltip" data-tooltip-title="Este método de pagamento não está disponível" tabindex="0" ' : '') .
                                'data-payment-method="' . $value . '"';
                            switch ($value) {
                                case $model::CREDIT_CARD:
                                    $return .= 'data-type="secondary-outline"';
                                    $image = Url::to('@web/images/payment-methods-icon.svg#credit-card-icon');
                                    break;
                                case $model::DEBIT_CARD:
                                    $return .= 'data-type="secondary-outline"';
                                    $image = Url::to('@web/images/payment-methods-icon.svg#debit-card-icon');
                                    break;
                                case $model::MBWAY:
                                    $image = Url::to('@web/images/payment-methods-icon.svg#mbway-icon');
                                    break;
                                case $model::MULTIBANCO:
                                    $image = Url::to('@web/images/payment-methods-icon.svg#multibanco-icon');
                                    break;
                                case $model::PAYPAL:
                                    $image = Url::to('@web/images/payment-methods-icon.svg#paypal-logo-icon');
                                    break;
                            }
                            $return .= '>';

                            $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : "") . (!$paymentMethod->state ? 'disabled ' : '') . ' >';
                            $return .= '<span aria-hidden="true">';
                            switch ($value) {
                                case $model::PAYPAL:
                                    $return .= '<svg id="paypal-logo-icon" class="icon" viewBox="0 0 14 18" xmlns="http://www.w3.org/2000/svg">
                                                    <path id="path3" d="M11.9792 4.46694C12.0185 2.42229 10.3335 0.853714 8.01648 0.853714H3.22392C3.11224 0.853661 3.00421 0.893527 2.91929 0.966129C2.83437 1.03873 2.77814 1.1393 2.76074 1.24971L0.840484 13.2594C0.831892 13.3138 0.835187 13.3694 0.850141 13.4225C0.865094 13.4755 0.891352 13.5247 0.927105 13.5665C0.962859 13.6084 1.00726 13.6421 1.05725 13.6652C1.10724 13.6882 1.16163 13.7002 1.21668 13.7002H4.05596L3.61223 16.481C3.60364 16.5354 3.60693 16.5911 3.62189 16.6441C3.63684 16.6971 3.6631 16.7463 3.69885 16.7882C3.7346 16.8301 3.779 16.8637 3.82899 16.8868C3.87898 16.9099 3.93338 16.9218 3.98842 16.9218H6.30139C6.41297 16.9218 6.51243 16.8818 6.59758 16.8094C6.68199 16.7367 6.69594 16.6364 6.71356 16.5258L7.39255 12.5276C7.4098 12.4174 7.46595 12.2742 7.55073 12.2014C7.63552 12.1287 7.70965 12.089 7.8216 12.089H9.23683C11.5061 12.089 13.4311 10.4745 13.7831 8.22931C14.0323 6.63576 13.3497 5.18547 11.9792 4.46657V4.46694Z" />
                                                    <path id="path2" d="M4.67035 9.2711L3.9631 13.7593L3.519 16.5747C3.51046 16.6291 3.51381 16.6847 3.52881 16.7378C3.54381 16.7908 3.57011 16.8399 3.6059 16.8817C3.64169 16.9236 3.68611 16.9572 3.73612 16.9802C3.78612 17.0033 3.84052 17.0152 3.89556 17.0151H6.3436C6.45517 17.0151 6.56307 16.9752 6.64785 16.9026C6.73263 16.83 6.78873 16.7295 6.80604 16.6191L7.45127 12.5273C7.46866 12.4169 7.52483 12.3164 7.60967 12.2438C7.69452 12.1712 7.80246 12.1313 7.91408 12.1313H9.355C11.6243 12.1313 13.5493 10.4745 13.9017 8.2293C14.1512 6.63575 13.3497 5.18547 11.9792 4.46657C11.9755 4.63628 11.9609 4.80563 11.9348 4.97351C11.5828 7.218 9.65706 8.8751 7.3885 8.8751H5.13316C5.02151 8.87522 4.91356 8.91521 4.82872 8.98786C4.74389 9.06052 4.68773 9.16108 4.67035 9.27147" />
                                                    <path d="M3.96273 13.7593H1.11465C1.05961 13.7593 1.00523 13.7474 0.955251 13.7243C0.905275 13.7012 0.860894 13.6676 0.825168 13.6257C0.789442 13.5838 0.763221 13.5346 0.748313 13.4816C0.733405 13.4286 0.730165 13.3729 0.738816 13.3185L2.65907 1.1307C2.67647 1.02034 2.73264 0.919824 2.81748 0.84723C2.90232 0.774635 3.01027 0.73473 3.12189 0.734695H8.01648C10.3335 0.734695 12.0185 2.42229 11.9792 4.46657C11.4026 4.16388 10.7251 3.99086 9.98298 3.99086H5.90244C5.79076 3.99081 5.68273 4.03067 5.59781 4.10327C5.51289 4.17588 5.45666 4.27644 5.43926 4.38686L4.67072 9.2711L3.96236 13.7593H3.96273Z" />
                                                </svg>';
                                    break;

                                case $model::MULTIBANCO:
                                    $return .= '<svg id="multibanco-icon" class="icon" viewBox="0 0 20 19" xmlns="http://www.w3.org/2000/svg">
                                                    <path id="path2" fill-rule="evenodd" clip-rule="evenodd" d="M9.87965 19H18.0864C19.9592 19 19.9787 17.0168 19.7874 16.0381C19.6833 15.3797 18.5601 15.39 18.4365 16.0381V16.8016C18.4362 16.97 18.3689 17.1313 18.2493 17.2503C18.1298 17.3694 17.9678 17.4364 17.7988 17.4368H2.06721C1.89818 17.4364 1.73618 17.3694 1.61667 17.2503C1.49715 17.1313 1.42985 16.97 1.42951 16.8016V16.0381C1.30587 15.39 0.182746 15.3797 0.0786317 16.0381C-0.112677 17.0168 -0.0931561 19 1.77959 19H9.87965ZM4.07921 0H16.7316C17.6205 0 18.348 0.767362 18.348 1.70453V2.51856C18.348 3.6696 16.7863 3.66442 16.7863 2.52633V2.08303C16.7863 1.94551 16.7315 1.81364 16.6338 1.7164C16.5362 1.61916 16.4038 1.56454 16.2657 1.56454H3.58727C3.4492 1.56454 3.3168 1.61916 3.21917 1.7164C3.12154 1.81364 3.0667 1.94551 3.0667 2.08303V2.51856C3.0667 3.66312 1.57527 3.65534 1.57527 2.54318V1.70583C1.57917 0.768659 2.30537 0 3.19424 0H4.07921Z"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.0291 9.36001C18.4636 9.55325 18.8337 9.86589 19.096 10.2612C19.3583 10.6566 19.502 11.1183 19.5102 11.5921C19.5102 12.9635 18.3076 14.086 16.8383 14.086H12.7167C12.5379 14.0913 12.3642 14.0263 12.2332 13.905C12.1022 13.7837 12.0244 13.6159 12.0166 13.4379V5.62431C12.0173 5.44278 12.0901 5.2689 12.2191 5.14066C12.348 5.01242 12.5228 4.94024 12.705 4.9399H16.1369C16.6514 4.93871 17.1549 5.08847 17.5846 5.3705C18.0142 5.65252 18.351 6.05432 18.5528 6.52576C18.7546 6.99719 18.8126 7.51738 18.7195 8.02142C18.6263 8.52546 18.3862 8.99102 18.0291 9.36001ZM14.9539 8.72487H16.2618V8.71061C16.5553 8.66473 16.8229 8.51627 17.0165 8.29182C17.2101 8.06738 17.3172 7.7816 17.3186 7.48568C17.3175 7.15734 17.1861 6.84275 16.953 6.61057C16.7199 6.3784 16.4041 6.24752 16.0744 6.24649H13.439V12.7276H16.7798C16.952 12.7331 17.1235 12.704 17.2843 12.6421C17.445 12.5802 17.5916 12.4868 17.7153 12.3674C17.8391 12.248 17.9375 12.1051 18.0047 11.9471C18.0719 11.789 18.1065 11.6192 18.1065 11.4476C18.1065 11.276 18.0719 11.1061 18.0047 10.9481C17.9375 10.7901 17.8391 10.6471 17.7153 10.5277C17.5916 10.4083 17.445 10.3149 17.2843 10.253C17.1235 10.1912 16.952 10.1621 16.7798 10.1676H16.2592H14.9539C14.859 10.1676 14.7651 10.149 14.6775 10.1128C14.5898 10.0766 14.5102 10.0237 14.4431 9.95685C14.3761 9.89005 14.3229 9.81074 14.2866 9.72346C14.2503 9.63618 14.2316 9.54263 14.2316 9.44816C14.2316 9.35368 14.2503 9.26014 14.2866 9.17285C14.3229 9.08557 14.3761 9.00627 14.4431 8.93946C14.5102 8.87266 14.5898 8.81967 14.6775 8.78352C14.7651 8.74736 14.859 8.72875 14.9539 8.72875"></path>
                                                    <path d="M11.362 13.307C11.3779 13.4167 11.3715 13.5286 11.343 13.6358C11.3145 13.743 11.2646 13.8434 11.1963 13.9309C11.1279 14.0185 11.0426 14.0914 10.9453 14.1453C10.848 14.1993 10.7408 14.2331 10.6301 14.2448C10.5193 14.2565 10.4074 14.2458 10.3009 14.2134C10.1944 14.181 10.0956 14.1275 10.0104 14.0562C9.92512 13.9848 9.8552 13.8971 9.80479 13.7982C9.75438 13.6993 9.72452 13.5913 9.717 13.4807L9.03635 7.2705L6.64043 13.3433V13.3588V13.3718V13.3848V13.3925V13.4042V13.4172C6.58789 13.5087 6.51754 13.5889 6.43351 13.6531L6.42049 13.6635C6.37692 13.7026 6.32887 13.7366 6.27734 13.7646L6.26172 13.7723L6.2474 13.7801H6.23829H6.22788H6.21877H6.20836H6.20055H6.19144H6.18363H6.17582H6.16541C6.08761 13.8078 6.00593 13.8231 5.92335 13.8255H5.86348C5.77067 13.8228 5.67904 13.804 5.59279 13.7697H5.58107H5.56936H5.55895H5.55114H5.54073H5.53162H5.52511L5.5108 13.762L5.49778 13.7542H5.48997C5.44378 13.7297 5.40018 13.7006 5.35983 13.6673L5.3325 13.6427L5.31168 13.6233L5.26223 13.6103L5.2375 13.5831C5.20414 13.5429 5.17493 13.4995 5.1503 13.4535V13.4457L5.14249 13.4327L5.13469 13.4185V13.4094V13.399V13.3912V13.3796V13.3692V13.3575L2.69452 7.2705L2.01648 13.4807C1.99335 13.6978 1.88459 13.8968 1.71411 14.0341C1.54363 14.1713 1.3254 14.2354 1.10743 14.2124C0.889465 14.1894 0.689611 14.081 0.551837 13.9112C0.414063 13.7414 0.349654 13.5241 0.372779 13.307L1.17185 5.98594C1.19115 5.81353 1.24327 5.64635 1.32542 5.49338C1.42795 5.30225 1.57466 5.13816 1.75343 5.01465C1.93219 4.89114 2.1379 4.81175 2.35354 4.78305H2.39779C2.46754 4.77789 2.53758 4.77789 2.60732 4.78305C2.6915 4.78638 2.77516 4.79767 2.8572 4.81675C3.07308 4.86599 3.27358 4.9671 3.44122 5.11124C3.60886 5.25539 3.73854 5.43821 3.81895 5.64374L5.86739 10.8001L7.91192 5.62689C8.00807 5.38168 8.17387 5.16969 8.38905 5.01683C8.60423 4.86397 8.85946 4.77688 9.12355 4.7662C9.19329 4.76104 9.26333 4.76104 9.33308 4.7662H9.37732C9.59291 4.79511 9.79852 4.87457 9.97726 4.99806C10.156 5.12155 10.3027 5.28553 10.4054 5.47653C10.4454 5.55316 10.4789 5.63293 10.5057 5.71503C10.532 5.79949 10.5498 5.88632 10.559 5.97428L11.362 13.307Z"></path>
                                                </svg>';
                                    break;

                                case $model::MBWAY:
                                    $return .= '<svg id="mbway-icon" class="icon" viewBox="0 0 21 19" xmlns="http://www.w3.org/2000/svg">
                                                    <path id="path2" d="M1.52174 16.5714L1.45459 17.0829C1.42423 17.3349 1.62293 17.5566 1.88051 17.5566H18.5163C18.7748 17.5566 18.9735 17.3349 18.9441 17.0829L18.8751 16.5714C18.8337 16.1731 19.1244 15.8088 19.5218 15.7674C19.922 15.7242 20.2752 16.0158 20.3166 16.4132L20.381 16.9109C20.5107 18.023 19.8796 19 18.7555 19H1.64225C0.518111 19 -0.112953 18.024 0.0167558 16.9109L0.0811498 16.4132C0.123466 16.0158 0.475795 15.7242 0.87412 15.7674C1.27244 15.8097 1.56222 16.1731 1.52174 16.5714Z"  ></path>
                                                    <path d="M16.9 12.7151C17.7095 12.717 18.3544 12.1273 18.3378 11.3509C18.3213 10.5561 17.5982 10.0428 16.7915 10.0418H15.1632C14.8026 10.0418 14.5064 9.74194 14.5064 9.36662C14.5064 8.99037 14.8017 8.68956 15.1632 8.68956H16.2515C16.9846 8.66012 17.5504 8.2158 17.5853 7.52218C17.6221 6.77981 16.9837 6.22233 16.2027 6.22233H13.5625L13.5515 12.716H16.9V12.7151ZM18.9017 7.51758C18.9017 8.19464 18.6616 8.57825 18.2642 9.05017L18.2247 9.098L18.2799 9.13204C19.0664 9.61132 19.6156 10.3362 19.6561 11.3536C19.7168 12.8697 18.4326 14.1235 16.9074 14.1208H12.8873C12.4964 14.1208 12.1799 13.7951 12.1799 13.3949V5.59771C12.1799 5.19571 12.4964 4.87189 12.8855 4.87189L16.2045 4.88109C17.6516 4.88201 18.9017 5.94544 18.9017 7.51758Z"></path>
                                                    <path d="M5.94471 11.4475L5.9631 11.5027L5.98334 11.4475C6.17008 10.9341 6.39455 10.3656 6.6328 9.74561C6.87842 9.09339 7.12312 8.46969 7.36782 7.87542C7.61528 7.27195 7.84894 6.7338 8.07248 6.26464C8.2951 5.78537 8.48 5.45603 8.62259 5.27573C8.84245 5.01263 9.13314 4.88017 9.49467 4.88017H9.66118C9.88288 4.88017 10.0558 4.93812 10.1855 5.04851C10.3042 5.15246 10.375 5.27205 10.3953 5.40912L11.4339 13.4658C11.4339 13.6737 11.3741 13.8337 11.2563 13.9533C11.1386 14.0646 10.9702 14.1198 10.7504 14.1198C10.5305 14.1198 10.3557 14.0674 10.2278 13.9653C10.0862 13.8632 10.0052 13.7289 9.98499 13.5624C9.95003 13.2947 9.91783 12.9966 9.88564 12.67C9.83964 12.3444 9.67774 10.9388 9.63174 10.5846C9.58942 10.2194 9.29689 7.94349 9.19754 7.11649L9.18834 7.04657L8.85533 7.74479C8.74218 7.98489 8.61983 8.27375 8.48552 8.60952C8.35305 8.94529 8.2169 9.30037 8.08352 9.67478C7.93817 10.0381 7.29515 11.8761 7.29515 11.8761C7.23535 12.0427 7.1222 12.3784 7.02009 12.6875C6.91614 12.9948 6.82139 13.2726 6.79563 13.3259C6.64292 13.6295 6.34487 13.8301 5.96586 13.8328C5.58226 13.831 5.2842 13.6295 5.13334 13.3259C5.10574 13.2726 5.01099 12.9938 4.90704 12.6875C4.80309 12.3784 4.6927 12.0427 4.63014 11.8761C4.63014 11.8761 3.98712 10.0381 3.84361 9.67478C3.7093 9.30037 3.57499 8.94621 3.44069 8.60952C3.30638 8.27375 3.18403 7.98489 3.07364 7.74479L2.73879 7.04657L2.73143 7.11649C2.63024 7.94349 2.34046 10.2194 2.29631 10.5846C2.25031 10.9388 2.08841 12.3444 2.04425 12.67C2.01021 12.9966 1.9771 13.2947 1.94214 13.5624C1.9219 13.7289 1.84095 13.8632 1.70112 13.9653C1.57141 14.0674 1.39755 14.1198 1.17677 14.1198C0.956906 14.1198 0.7904 14.0646 0.672651 13.9533C0.554901 13.8337 0.495106 13.6718 0.494186 13.4658L1.53277 5.40912C1.55577 5.27205 1.62477 5.15246 1.74344 5.04851C1.87222 4.93812 2.04793 4.88017 2.26595 4.88017H2.4343C2.79674 4.88017 3.08652 5.01355 3.30546 5.27573C3.44897 5.45603 3.63203 5.78445 3.85557 6.26464C4.08003 6.7338 4.31369 7.27195 4.56023 7.87542C4.80493 8.46969 5.05054 9.09339 5.29708 9.74561C5.5335 10.3656 5.75796 10.9341 5.94471 11.4475Z"></path>
                                                    <path id="path2" d="M3.90616 0H16.5422C17.7325 0 18.325 0.894161 18.4639 2.07258L18.5172 2.44974C18.5595 2.85451 18.2624 3.21696 17.865 3.25927C17.4667 3.30159 17.1088 3.00905 17.0674 2.60429L17.0168 2.24368C16.9635 1.79568 16.774 1.45071 16.3186 1.45071H4.1297C3.67434 1.45071 3.48484 1.79568 3.43148 2.24368L3.38272 2.60429C3.34133 3.00905 2.9844 3.30251 2.58332 3.25927C2.18499 3.21696 1.88786 2.85451 1.93109 2.44974L1.98445 2.07258C2.1252 0.893241 2.7167 0 3.90616 0Z"  ></path>
                                                </svg>';
                                    break;

                                default:
                                    $return .= '<svg class="icon">
                                                    <use xlink:href="' . $image . '"></use>
                                                </svg>';
                                    break;
                            }

                            $return .= '</span>';
                            $return .= '<span class="fw-semi-bold">' . $label . "</span>";
                            $return .= '</label>';

                            return $return;
                        },
                        'tag' => 'section',
                        'class' => 'margin-top-400 d-grid grid-auto-fit',
                        'data-item-size' => 'small'
                    ]
                )
                ->label(false);
            ?>

            <div class="divider"></div>
            <?= $form->field($model, 'read_terms', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-50'
                ]
            ])
                ->label(null, [
                    'class' => 'fs-200 fw-medium letter-spacing-2',
                ])
                ->checkbox([
                    'template' => '<div class="d-flex gap-1 align-items-center margin-top-300">
                                        {input}
                                        {beginLabel}
                                            {labelTitle}
                                        {endLabel}
                                    </div>
                                    {error}
                                    ',
                    'class' => 'fs-200 fw-medium letter-spacing-2',
                ]) ?>
            <?= Html::submitButton('Confirmar', [
                'class' => 'form__submit-button button fill-sm d-block push-to-center-md',
                'data-size' => 'large-md',
            ]) ?>
        </section>
        <?php ActiveForm::end(); ?>
    </div>
</section>