<?php

use common\models\TicketItem;
use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\TicketMessageForm $model */
/** @var common\models\SupportTicket $supportTicket */
/** @var yii\data\ActiveDataProvider $dataProvider */



$this->registerJsFile('@web/js/scrolldown_chat.js');

$this->title = $supportTicket->title;
$this->params['breadcrumbs'][] = ['label' => 'Tickets de Suporte', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-ticket-create">

    <div class="d-flex mb-3 gap-2">
        <?= Html::a('Concluir ticket', ['conclude-ticket', 'ticket_id' => $supportTicket->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if (TicketItem::findOne(['support_ticket_id' => $supportTicket->id])) {
            $buttonText = "Ver item";
        } else {
            $buttonText = "Associar item";
        }
        echo Html::a($buttonText, ['item', 'ticket_id' => $supportTicket->id], ['class' => 'btn btn-success']);
        ?>

    </div>

    <div class="card">
        <div id="chat" class="card-body overflow-auto" data-mdb-perfect-scrollbar="true" style="position: relative; height: 450px">

            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'viewParams' => ['client_id' => $supportTicket->client_id],
                'summary' => '',
                'emptyText' => "<p class='fw-medium text-align-center'>Esta chat ainda não tem mensagens!</p>",
                'itemView' => '_message',
            ]); ?>


        </div>
        <div class="card-footer text-muted p-3">


            <?= $this->render('_form', [
                'ticket_id' => $supportTicket->id,
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>