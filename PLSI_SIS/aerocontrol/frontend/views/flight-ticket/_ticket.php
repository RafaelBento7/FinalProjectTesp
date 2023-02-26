<?php

/** @var \common\models\FlightTicket $model */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<li>
    <article class="[ flight-ticket__item ] [ bg-primary border-radius-1 ]" flight-ticket>
        <p class="[ flight-date ] [ fs-350 ]">Data:
            <span class="fw-semi-bold letter-spacing-2" flight-ticket-date><?= Html::encode(Yii::$app->formatter->asDate($model->flight->estimated_departure_date)) ?></span>
        </p>
        <p class="[ flight-state ] [ fs-350 margin-top-50-sm ]">Estado:
            <span class="fw-semi-bold letter-spacing-2" flight-ticket-state><?= Html::encode($model->flight->state) ?></span>
        </p>

        <div class="[ flight-hours ] [ justify-self-end-sm justify-self-start-md ]">
            <div class="flight-trip">
                <p class="[ flight-trip__departure-time ] [ fs-350 fw-medium letter-spacing-2 text-align-right ]" flight-ticket-departure-time>
                    <?= Html::encode(Yii::$app->formatter->asTime($model->flight->estimated_departure_date)) ?>
                </p>
                <p class="[ flight-trip__departure-city ] [ fs-350 fw-light letter-spacing-2 text-align-right ]" flight-ticket-departure-city>
                    <?= Html::encode($model->flight->originAirport->city) ?>
                </p>

                <div class="[ flight-trip__icon ] [ align-self-center ]">
                    <span aria-hidden="true">
                        <svg class="icon">
                            <use xlink:href="<?= Url::to('@web/images/flight-result-trip.svg#flight-result-trip') ?>">
                            </use>
                        </svg>
                    </span>
                </div>

                <p class="[ flight-trip__arrival-time ] [ fs-350 fw-medium letter-spacing-2 ]" flight-ticket-arrival-time>
                    <?= Html::encode(Yii::$app->formatter->asTime($model->flight->estimated_arrival_date)) ?>
                </p>
                <p class="[ flight-trip__arrival-city ] [ fs-350 fw-light letter-spacing-2 ]" flight-ticket-arrival-city>
                    <?= Html::encode($model->flight->arrivalAirport->city) ?>
                </p>

            </div>
        </div>

        <button class="[ flight-ticket__see-more-details button ] [ margin-top-200-sm height-min-content ]" aria-expanded="false" aria-controls="more-details" data-type>Ver mais detalhes</button>

        <div class="flight-more-details__wrapper" id="more-details">
            <section class="[ flight-ticket__more-details ] [ width-100 margin-top-200 ]">
                <p class="[ flight-bought-date ] [ fs-350 ]">Data de Compra:
                    <span class="fw-semi-bold letter-spacing-2" flight-ticket-bought-date><?= Html::encode(date('d-m-Y', strtotime($model->purchase_date))) ?></span>
                </p>
                <p class="[ flight-distance ] [ fs-350 ]">Distância:
                    <span class="letter-spacing-2 uppercase" flight-ticket-distance><?= Html::encode($model->flight->distance) ?>km</span>
                </p>
                <div class="[ flight-ticket__grouped-details ]">
                    <p class="[ flight-company ] [ fs-350 overflow-wrap-break ]" flight-ticket-company><?= Html::encode($model->flight->airplane->company->name) ?></p>
                    <p class="[ flight-terminal ] [ fs-350 justify-self-end ]">Terminal:
                        <span class="fw-semi-bold letter-spacing-2" flight-ticket-terminal><?= Html::encode($model->flight->terminal) ?></span>
                    </p>

                    <div class="[ flight-price ] [ fs-350 d-flex push-to-right ]">
                        <p><s class="text-black-200 italic" flight-ticket-discount><?= ($model->flight->discount_percentage !== 0) ? Html::encode($model->flight->price . '€') : ' ' ?></s></p>
                        <p class="fw-semi-bold" flight-ticket-price><?= Html::encode($model->price) ?>€</p>
                    </div>
                </div>
                <?php if ($model->passengers) : ?>
                    <section class="flight-passengers">
                        <h2 class="fs-500 fw-semi-bold">Passageiros</h2>
                        <table class="[ flight-passengers-table ] [ margin-top-100 fs-350 ]">
                            <thead>
                                <tr>
                                    <th class="fw-medium">Nome:</th>
                                    <th class="fw-medium">Género:</th>
                                    <th class="fw-medium">Lugar:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($model->passengers as $passenger) : ?>
                                    <tr>
                                        <td flight-ticket-passenger-name><?= $passenger->name ?></td>
                                        <td flight-ticket-passenger-gender><?= $passenger->gender ?></td>
                                        <td flight-ticket-passenger-seat><?= $passenger->seat ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </section>
                <?php endif; ?>
                <div class="[ flight-ticket-actions ] [ d-flex justify-content-space-between align-self-end ]">
                    <?php if ($model->checkin === 0) {
                        echo Html::a('Cancelar', ['flight-ticket/delete', 'flight_ticket_id' => $model->flight_ticket_id], ['data-method' => 'post', 'class' => 'button', 'data-type' => 'error']);
                        echo Html::a('Check-in', ['flight-ticket/checkin', 'flight_ticket_id' => $model->flight_ticket_id], ['data-method' => 'post', 'class' => 'button']);
                    } ?>
                </div>

            </section>
        </div>
    </article>
</li>