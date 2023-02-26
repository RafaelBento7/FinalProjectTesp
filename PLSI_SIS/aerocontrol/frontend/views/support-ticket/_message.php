<?php

/** @var \common\models\TicketMessage $model */
/** @var int $client_id */

use common\models\SupportTicket;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;


$user = User::findOne(['id' => $model->sender_id]);
if ($client_id != $model->sender_id) {
?>
    <li class="d-flex">
        <div class="chat-message">
            <p class="fw-light italic">
                <?= Html::encode($user->username) ?>
            </p>
            <div class="border-radius-1 bg-neutral-800 margin-top-50 padding-inline-200 padding-block-100 text-break">
                <p>
                    <?= Html::encode($model->message) ?>
                </p>
            </div>
        </div>
    </li>
<?php
} else {
?>
    <li class="d-flex justify-content-end">
        <div class="chat-message">
            <p class="fw-light italic text-align-right">
                <?= Html::encode($user->username) ?>
            </p>
            <div class="text-white border-radius-1 bg-primary-accent-400 margin-top-50 padding-inline-200 padding-block-50 text-break">
                <p>
                    <?= Html::encode($model->message) ?>
                </p>
            </div>
        </div>
    </li>
<?php
}
?>
