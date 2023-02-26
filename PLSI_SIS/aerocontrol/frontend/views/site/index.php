<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'AeroControl';
?>
<section class="even-columns text-white gap-0">
    <div class="card-landing-page" data-type="restaurant">
        <div class="[ card__content ]  [ text-align-center flow ]" data-flow-space="medium">
            <div class="flow" data-flow-space="small">
                <h2 class="fs-500 fw-bold">Restaurantes</h2>
                <p class="fw-medium">Conheça todos os restaurantes disponíveis no aeroporto!</p>
            </div>
            <?= Html::a('Saber mais', ['restaurant/index'], ['class' => 'button', 'data-type' => 'secondary']) ?>
        </div>
    </div>
    <div class="card-landing-page" data-type="store">
        <div class="[ card__content ] [ text-align-center flow ]" data-flow-space="medium">
            <div class="flow" data-flow-space="small">
                <h2 class="fs-500 fw-bold">Lojas</h2>
                <p class="fw-medium">Conheça todas as lojas disponíveis no aeroporto!</p>
            </div>
            <?= Html::a('Saber mais', ['store/index'], ['class' => 'button', 'data-type' => 'secondary']) ?>
        </div>
    </div>
</section>