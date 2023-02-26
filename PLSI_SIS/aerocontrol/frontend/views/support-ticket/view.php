<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \common\models\TicketMessageForm $model */
/** @var \common\models\SupportTicket $ticket */
/** @var int $client_id */

use common\models\SupportTicket;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;

$this->registerJsFile('@web/js/scrolldown_chat.js');

$this->title = "Meus Tickets Suporte";
?>

<section class="padding-block-700">
    <div class="container" data-type="small-md">
        <h1 class="fs-550 fw-bold text-break max-width-35ch">
            Ticket nº<?php echo Html::encode($ticket->id); ?> - <span class="fw-medium"><?php echo Html::encode($ticket->title); ?></span>
        </h1>
        <div class="d-flex justify-content-space-between margin-top-300">
            <p class="fw-medium letter-spacing-1">
                Estado: <span class="italic"><?php echo Html::encode($ticket->state); ?></span>
            </p>
            <?php
            if ($ticket->state != SupportTicket::STATE_DONE) {
                echo Html::a('Fechar ticket', ['support-ticket/conclude-ticket', 'ticket_id' => $ticket->id], ['data-method' => 'post', 'class' => 'button ', 'data-type' => 'error']);
            }
            ?>

        </div>
        <section class="margin-top-500 border-radius-1 box-shadow-1">
            <ul role="list" id="chat" class="[ chat-messages-wrapper ]  [ padding-inline-300 padding-block-300 flow ]" data-flow-space="large">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'viewParams' => ['client_id' => $client_id],
                    'summary' => '',
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'flow',
                        'role' => 'list',
                        'data-flow-space' => 'medium'
                    ],
                    'emptyText' => "<p class='fw-medium text-align-center'> Você ainda não tem mensagens!</p>",
                    'itemView' => '_message',
                ]); ?>
            </ul>
            <div class="chat-footer">
                <?php $form = ActiveForm::begin([
                    'id' => 'support-ticket',
                    'action' => ['view', 'ticket_id' => $ticket->id],
                    'errorCssClass' => 'invalid',
                    'requiredCssClass' => 'invalid',
                    'successCssClass' => 'valid',
                    'validateOnType' => true,
                    'validationDelay' => 500,
                    'options' => [
                        'class' => 'd-flex gap-0',
                    ]
                ]); ?>

                <?= $form->field($model, 'message', [
                    'errorOptions' => [
                        'tag' => false,
                        'class' => 'input__error margin-top-50'
                    ],
                    'options' => ['class' => 'form__group flex-grow-1'],
                ])
                    ->label(false, [
                        'class' => '[ input__label ] [ margin-bottom-50 visually-hidden ]'
                    ])
                    ->textInput([
                        'placeholder' => 'Insira aqui a sua mensagem',
                        'class' => 'form__input height-100 border-none border-top-radius-0 border-bottom-right-radius-0'
                    ]) ?>

                <button type="submit" class="[ button ] [ border-top-radius-0  border-bottom-left-radius-0 ] ">
                    <span class="visually-hidden">Enviar mensagem</span>
                    <span aria-hidden="true">
                        <svg class="icon">
                            <use xlink:href="<?= Url::to('@web/images/send-message-icon.svg#send-message-icon') ?>"></use>
                        </svg>
                    </span></button>

                <?php ActiveForm::end(); ?>
            </div>
        </section>
    </div>
</section>