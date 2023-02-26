<?php

use common\models\LostItem;
use common\models\SupportTicket;
use common\models\TicketItem;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\LostItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var SupportTicket $ticket */

$this->registerJsFile('@web/js/scrolldown_chat.js');

if ($ticket->ticketItems) {
    $this->title = "Ver Item";
} else {
    $this->title = "Associar Item";
}
$this->params['breadcrumbs'][] = ['label' => 'Tickets de Suporte', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-ticket-create">

    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            'id',
            'description',
            [
                'attribute' => 'image',
                'value' => function ($model) {
                    return Url::to($model->getImagePathUrl());
                },
                'format' => ['image', ['width' => '100', 'class' => 'img-fluid']],
                'filter' => '',
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) use ($ticket) {
                        if ($ticket->ticketItems)
                            return Html::a("Remover", ['remove-item-from-ticket', 'ticket_id' => $ticket->id, 'lost_item_id' => $model->id], ['class' => 'btn btn-danger']);
                        else return Html::a("Associar", ['add-item-to-ticket', 'ticket_id' => $ticket->id, 'lost_item_id' => $model->id], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>