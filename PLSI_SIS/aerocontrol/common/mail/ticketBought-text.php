<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */
/** @var common\models\FlightTicket $flightTicket */

use yii\helpers\Html;

?>

Olá <?= Html::encode($user->first_name . ' ' . $user->last_name) ?>,

Verifique abaixo todas as informações do seu bilhete!
Informações do Voo
<?= Html::encode($flightTicket->flight->originAirport->city . "  -> " . $flightTicket->flight->arrivalAirport->city)?>
<?= Html::encode("Data do voo:" . Yii::$app->formatter->asDate($flightTicket->flight->estimated_departure_date))?>

<?= Html::encode("Horário de partida: " . Yii::$app->formatter->asDatetime($flightTicket->flight->estimated_departure_date))?>
<?= Html::encode("Horário de chegada: " . Yii::$app->formatter->asDatetime($flightTicket->flight->estimated_arrival_date))?>


Informações do bilhete
<?= Html::encode("Método de pagamento: " . $flightTicket->paymentMethod->name)?>
<?= Html::encode("Preço: " . $flightTicket->price)?>
<?= Html::encode("Data de compra: " . Yii::$app->formatter->asDatetime($flightTicket->purchase_date))?>

Passageiros
<?php
foreach ($flightTicket->passengers as $passenger):?>
    <?= Html::encode($passenger->name)?>
    <?= Html::encode($passenger->gender)?>
    Bagagem Extra:
    <?php if ($passenger->extra_baggage): ?>
        com
    <?php else:?>
        sem
    <?php endif;?>

    <?= Html::encode("Lugar: ". $passenger->seat)?>
<?php endforeach; ?>

Caso queira efetuar o checkin ou cancelar o bilhete, pode fazê-lo através do nosso site ou da nossa aplicação! Aerocontrol!



