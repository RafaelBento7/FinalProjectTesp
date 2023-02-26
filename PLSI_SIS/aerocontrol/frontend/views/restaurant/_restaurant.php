<?php

/** @var \common\models\Restaurant $model */

use yii\helpers\Url;
use yii\helpers\Html;
?>

<li>
    <a href="<?= Url::to(['view', 'id' => $model->id]) ?>" class="[ card ]  [ d-block stacked-grid text-decoration-none ]">
        <img class="card__img" src="<?= Url::to($model->getLogoPathUrl()) ?>" alt="Restaurant logo">
        <div class="card-body__wrapper  d-flex flex-flow-row align-items-end">
            <div class="[ card__body ] [ text-white width-100 padding-100 ]">
                <p class="fs-300 fw-bold text-break"><?= Html::encode($model->name) ?></p>
            </div>
        </div>
    </a>
</li>