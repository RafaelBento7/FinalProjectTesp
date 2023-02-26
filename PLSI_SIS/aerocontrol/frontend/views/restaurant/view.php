<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Restaurant $model */

$this->title = $model->name;
?>

<section class="padding-block-700">
    <div class="container">
        <h1 class="fs-600 fw-bold text-align-center"><?= Html::encode($model->name) ?></h1>
        <section class="d-flex justify-content-space-between gap-4 flex-flow-column-md margin-top-400">
            <p class="max-width-75ch fw-semi-bold">Descrição: <span class="fw-light"><?= Html::encode($model->description) ?></span></p>
            <div class="order-first-lg flow text-break" data-flow-space="very-small" style="width: fit-content;">
                <?php if ($model->open_time == Yii::$app->formatter->nullDisplay || $model->close_time == Yii::$app->formatter->nullDisplay || $model->close_time == $model->open_time):?>
                    <p class="fw-semi-bold">Horário: <span class="fw-light">Aberto 24 horas</span></p>
                <?php else:?>
                    <p class="fw-semi-bold">Horário: <span class="fw-light"><?= Html::encode($model->open_time . " - "  . $model->close_time)?></span></p>
                <?php endif;?>
                <p class="fw-semi-bold">Telemóvel: <span class="fw-light"><?= Html::encode($model->phone) ?></span></p>
                <p class="fw-semi-bold">Website: <span class="fw-light"><?= Html::encode($model->name) ?></span>
                </p>
            </div>
        </section>
        <section class="margin-top-600">
                <h2 class="fs-500 fw-semi-bold">Ementa:</h2>
            <?php if ($model->restaurantItems):?>
                <ul role="list" class="d-grid grid-auto-fit margin-top-100" data-item-size="medium">
                    <?php foreach ($model->restaurantItems as $item):?>
                        <li class="[ card ]  [ d-block stacked-grid ]">
                            <img class="card__img" src="<?= Url::to($item->getImagePathUrl()) ?>" alt="Imagem de um item da ementa">
                            <div class="card-body__wrapper  d-flex flex-flow-row align-items-end">
                                <div class="[ card__body ] [ text-white width-100 padding-100 ]" data-animation="none">
                                    <p class="fs-300 fw-bold text-break"><?= Html::encode($item->item) ?></p>
                                </div>
                            </div>
                        </li>
                    <?php endforeach;?>
                </ul>
            <?php else:;?>
                <p class="margin-top-100">Ainda não existe uma ementa diponivel.</p>
            <?php endif;?>
        </section>
    </div>
</section>
