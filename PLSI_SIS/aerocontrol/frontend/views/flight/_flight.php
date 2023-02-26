<?php

/** @var \common\models\Flight $model */
/** @var string $flightType */

use common\models\FlightForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<li class="[ flight-result__wrapper ] [ bg-neutral-800 border-radius-1 ]">
    <p class="[ flight-company ] [ fs-300 letter-spacing-2 ]"><?= $model->airplane->company->name ?></p>
    <div class="[ flight-hours flight-result__hours ] [ justify-self-center-md ]">
        <p class="fs-300 letter-spacing-2 text-align-center fw-semi-bold "><?= Html::encode(Html::encode(Yii::$app->formatter->asDate($model->estimated_departure_date))) ?></p>
        <div class="flight-trip">
            <p class="[ flight-trip__departure-time ] [ fs-300 fw-medium letter-spacing-2 text-align-right ]"><?= Html::encode(Yii::$app->formatter->asTime($model->estimated_departure_date)) ?></p>
            <p class="[ flight-trip__departure-city ] [ fs-300 fw-light letter-spacing-2 text-align-right ]"><?= Html::encode($model->originAirport->name) ?></p>

            <div class="[ flight-trip__icon ] [ align-self-center ]">
                <span aria-hidden="true">
                    <svg class="icon">
                        <use xlink:href="<?= Url::to('@web/images/flight-result-trip.svg#flight-result-trip') ?>"></use>
                    </svg>
                </span>
            </div>
            <p class="[ flight-trip__arrival-time ] [ fs-300 fw-medium letter-spacing-2 ]"><?= Html::encode(Yii::$app->formatter->asTime($model->estimated_arrival_date)) ?></p>
            <p class="[ flight-trip__arrival-city ] [ fs-300 fw-light letter-spacing-2 ]"><?= Html::encode($model->arrivalAirport->name) ?></p>
        </div>
    </div>

    <div class="[ flight-result__details ] [ flow text-align-right ]" data-flow-space="very-small">
        <p class="fs-300 letter-spacing-2">Lugares disponíveis: <span class="fw-semi-bold"><?= Html::encode($model->passengers_left) ?></span>
        </p>
        <div class="flow" data-flow-space="extra-small">
            <?php if ($model->discount_percentage !== 0) : ?>
                <p class="fs-300 italic text-error"><s><?= Html::encode($model->price) ?>€</s></p>
            <?php endif; ?>
            <p class="fs-300 fw-bold letter-spacing-2"><?= Html::encode($model->price - ($model->discount_percentage / 100 * $model->price)) ?>€</p>
        </div>

    </div>
    <?php
    $reserveBtnOptions = [
        'class' => '[ flight-result__book button ] [ justify-self-end ]',
        'data-type' => 'secondary',
        'tabindex' => 0,
        'data-flight-ticket-reserve' => true,
        'data-flight-id' => $model->id
    ];

    if ($flightType === FlightForm::FLIGHT_TYPE_GO)
        $reserveBtnOptions = array_merge($reserveBtnOptions, ['data-flight-trip-go' => '']);
    else if ($flightType === FlightForm::FLIGHT_TYPE_BACK)
        $reserveBtnOptions = array_merge($reserveBtnOptions, ['data-flight-trip-back' => '']);

    echo Html::a(
        '<span aria-hidden="true">
        <svg class="icon flight-result-book__icon">
            <use xlink:href="' . Url::to('@web/images/success-icon.svg#success') . '"></use>
        </svg>
    </span>
    <span data-book-btn-text>Reservar</span>',
        ['flight-ticket/create'],
        $reserveBtnOptions
    ) ?>
</li>