<?php

/** @var \common\models\SupportTicket $model */

use common\models\SupportTicket;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<li>
    <article class="[ support-ticket__item ] [ d-grid grid-auto-flow-column-md bg-primary border-radius-1 outline-1 padding-100 ]" data-support-ticket>
        <p class="fs-350 fw-medium">Ticket nº<?= Html::encode($model->id) ?> - <?= Html::encode($model->title) ?></p>
        <p class="fs-350 margin-top-100-sm">Estado: <span class="fw-medium fs-italic"><?= Html::encode($model->state) ?></span></p>
        <div class="d-flex flex-flow-column-sm justify-content-space-between margin-top-200-sm gap-2">
            <?php if (!empty($model->ticketItems)) : ?>

                <button class="[ button ]" data-type="secondary-outline" data-support-ticket-see-item data-image-path="<?=
                                                                                                                        // Vai buscar o Url do primeiro ticketItem
                                                                                                                        Url::to($model->ticketItems[0]->lostItem->getImagePathUrl()) ?>">
                    Ver item</button>
            <?php endif ?>
            <?php echo Html::a('Ver mais detalhes', ['support-ticket/view', 'ticket_id' => $model->id], ['data-method' => 'post', 'class' => 'button push-to-right-md']);?>
        </div>
    </article>
</li>