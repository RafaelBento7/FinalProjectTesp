<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \common\models\SupportTicketForm $model */

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = "Meus Tickets Support";
$this->registerJsFile('@web/js/support-tickets.js', [
    'type' => 'module',
]);
?>

<section class="container padding-block-700" data-type="small-md">
    <h1 class="fs-600 fw-bold text-align-center">Meus Tickets Suporte</h1>

    <dialog id="newSupportTicketModal" class="[ modal container padding-300 ]" data-type="very-small-md" data-modal>
        <button class="[ modal__close-btn ] [ d-block push-to-right ]" data-close-modal>
            <span class="visually-hidden">
                Close modal
            </span>
            <img src="<?= Url::to('@web/images/close-icon.svg') ?>" alt="" aria-hidden="true">
        </button>

        <section class="margin-top-100 text-black-400">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </section>
    </dialog>

    <button class=" [ button ] [ d-block margin-top-400 push-to-right ]" data-type="primary-outline" data-toggle="modal" data-target="#newSupportTicketModal" data-force-toggle-open="false" id="newSupportTicket">
        Novo Ticket
    </button>

    <div class="margin-top-100">
        <dialog class="[ support-ticket-modal ] [ modal container padding-300 ]" data-type="very-small-md" data-modal data-support-ticket-modal>
            <button class="[ modal__close-btn ] [ d-block push-to-right ]" data-close-modal><span class="visually-hidden">Close
                    modal</span>
                <img src="<?= Url::to('@web/images/close-icon.svg') ?>" alt="" aria-hidden="true"></button>
            <section class="[ support-ticket-modal__image-item ] [ margin-top-400 margin-inline-auto ]">
                <img src="" alt="Imagem do item do support ticket">
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
            'emptyText' => "<p class='fw-medium text-align-center'> Você ainda não fez nenhum ticket!</p>",
            'itemView' => '_ticket',
        ]); ?>
    </div>


</section>