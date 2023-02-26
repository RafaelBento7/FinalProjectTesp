<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */
/** @var common\models\FlightTicket $flightTicket */

?>
<div class="ticket-bought-email">
    <p>Olá <?= Html::encode($user->first_name . ' ' . $user->last_name) ?>,</p>

    <p>Verifique abaixo todas as informações do seu bilhete!</p>
    <p><b>Informações do Voo</b>
        <p> <?= Html::encode($flightTicket->flight->originAirport->city . "  -> " . $flightTicket->flight->arrivalAirport->city)?></p>
        <p> <?= Html::encode("Data do voo: " . Yii::$app->formatter->asDate($flightTicket->flight->estimated_departure_date))?></p>
        <div>
            <div> <?= Html::encode("Horário de partida: " . Yii::$app->formatter->asDatetime($flightTicket->flight->estimated_departure_date))?></div>
            <div> <?= Html::encode("Horário de chegada: " . Yii::$app->formatter->asDatetime($flightTicket->flight->estimated_arrival_date))?></div>
        </div>
    </p>
    <p> <b>Informações do bilhete</b>
        <div> <?= Html::encode("Método de pagamento: " . $flightTicket->paymentMethod->name)?></div>
        <div> <?= Html::encode("Preço: " . $flightTicket->price)?>€</div>
        <div> <?= Html::encode("Data de compra: " . Yii::$app->formatter->asDatetime($flightTicket->purchase_date))?></div>
    </p>
    <p> <b>Passageiros</b>
        <?php
        foreach ($flightTicket->passengers as $passenger):?>
            <br>
            <div><?= Html::encode($passenger->name)?></div>
            <div><?= Html::encode($passenger->gender)?></div>
            <div>
            <label for="extra_baggage"> Bagagem Extra </label>
            <?php if ($passenger->extra_baggage): ?>
                <input id="extra_baggage" type="checkbox" checked disabled>
            <?php else:?>
                <input id="extra_baggage" type="checkbox" disabled>
            <?php endif;?>
            </div>
            <div><?= Html::encode("Lugar: " . $passenger->seat)?></div>
        <?php endforeach; ?>
    </p>

    <p>
        Caso queira efetuar o checkin ou cancelar o bilhete, pode fazê-lo através do nosso site ou da nossa aplicação! Aerocontrol!
    </p>
</div>
