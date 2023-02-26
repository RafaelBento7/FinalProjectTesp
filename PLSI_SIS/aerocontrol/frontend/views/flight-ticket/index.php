<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = "Meus Bilhetes";
$this->registerJsFile('@web/js/flight-tickets.js', [
    'type' => 'module',
]);
?>

<section class="container padding-block-700" data-type="small-md">
    <h1 class="fs-600 fw-bold text-align-center">Meus Bilhetes</h1>
    <div class="margin-top-400">

        <dialog id="flight-ticket-modal" class="[ flight-ticket-modal modal ] [ padding-300 text-black-400 ]" data-modal>
            <button class="[ modal__close-btn ] [ d-block push-to-right ]" data-close-modal>
                <span class="visually-hidden">Fechar modal</span>
                <img src="<?= Url::to('@web/images/close-icon.svg') ?>" alt="" aria-hidden="true"></button>

            <section class="margin-top-400 d-flex justify-content-space-between">
                <button class="button" data-type="error">Cancelar</button>
                <button class="button">Check-in</button>

            </section>

            <section class="margin-top-600 flow fs-300">
                <div class="d-flex justify-content-space-between">
                    <p>Data: <span class="fw-semi-bold letter-spacing-2" flight-ticket-modal-date></span></p>
                    <p>Estado: <span class="fw-semi-bold letter-spacing-2" flight-ticket-modal-state></span>
                    </p>
                </div>

                <div class="d-flex justify-content-space-between">
                    <p>Origem: <span class="fw-medium" flight-ticket-modal-departure-city></span></p>
                    <p>Destino: <span class="fw-medium" flight-ticket-modal-arrival-city></span></p>
                </div>
                <div class="d-flex justify-content-space-between">
                    <p>Partida: <span flight-ticket-modal-departure-time></span></p>
                    <p>Chegada: <span flight-ticket-modal-arrival-time></span></p>
                </div>
                <div class="d-flex justify-content-space-between">
                    <p>Distãncia: <span class="letter-spacing-2 uppercase" flight-ticket-modal-distance></span>
                    </p>
                    <p>Terminal: <span class="fw-semi-bold letter-spacing-2" flight-ticket-modal-terminal></span></p>
                </div>
                <div class="d-flex justify-content-space-between">
                    <p>Data de Compra: <span class="fw-semi-bold letter-spacing-2" flight-ticket-modal-bought-date></span></p>
                    <div class="d-flex">
                        <p><s class="text-black-200 italic" flight-ticket-modal-discount></s></p>
                        <p class="fw-semi-bold" flight-ticket-modal-price></p>
                    </div>
                </div>
            </section>
            <section class="margin-top-400">
                <h2 class="fs-500 fw-semi-bold text-align-center">Passageiros</h2>
                <ul role="list" class="d-grid grid-auto-fit margin-top-300" flight-ticket-modal-passengers-list>
                    <template id="flight-ticket-modal-passenger-item-template">
                        <li>
                            <h3 class="fs-400 fw-medium">Passageiro <span class="letter-spacing-3" flight-ticket-modal-passenger-number></span>
                            </h3>
                            <div class="margin-top-100 flow-sm even-columns gap-0">
                                <div>
                                    <p class="fs-350">Nome:</p>
                                    <p class="fs-300 fw-light margin-top-50" flight-ticket-modal-passenger-name>
                                    </p>
                                </div>
                                <div class="d-flex gap-5">
                                    <div>
                                        <p class="fs-350">Género:</p>
                                        <p class="fs-300 fw-light margin-top-50" flight-ticket-modal-passenger-gender></p>
                                    </div>
                                    <div>
                                        <p class="fs-350">Lugar:</p>
                                        <p class="fs-300 fw-light margin-top-50" flight-ticket-modal-passenger-seat></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
            </section>
        </dialog>


        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'options' => [
                'tag' => 'ul',
                'class' => 'flow',
                'role' => 'list',
                'data-flow-space' => 'medium'

            ],
            'emptyText' => "<p class='fw-medium text-align-center'> Você ainda não comprou nenhum bilhete!</p>",
            'itemView' => '_ticket',
        ]); ?>

    </div>
</section>