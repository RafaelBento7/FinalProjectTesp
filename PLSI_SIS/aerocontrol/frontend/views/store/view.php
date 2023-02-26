<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Store $model */

$this->title = $model->name;
?>

<section class="padding-block-700">
    <div class="container">
        <h1 class="fs-600 fw-bold text-align-center"><?= Html::encode($model->name) ?></h1>
        <section class="d-flex justify-content-space-between gap-4 flex-flow-column-md margin-top-400">
            <p class="max-width-75ch fw-semi-bold">Descrição: <span class="fw-light"><?= Html::encode($model->description) ?></span></p>
            <div class="order-first-lg flow text-break" data-flow-space="very-small" style="width: fit-content;">
                <?php if ($model->open_time == null || $model->close_time == null || $model->close_time == $model->open_time):?>
                    <p class="fw-semi-bold">Horário: <span class="fw-light">Aberto 24 horas</span></p>
                <?php else:?>
                    <p class="fw-semi-bold">Horário: <span class="fw-light"><?= Html::encode($model->open_time . " - "  . $model->close_time)?></span></p>
                <?php endif;?>
                <p class="fw-semi-bold">Telemóvel: <span class="fw-light"><?= Html::encode($model->phone) ?></span></p>
                <p class="fw-semi-bold">Website: <span class="fw-light"><?= Html::encode($model->name) ?></span>
                </p>
            </div>
        </section>
    </div>
</section>
