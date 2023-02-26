<?php

use yii\helpers\Url;

?>
<!-- Se não houver experimentar outras datas -->
<div class="container width-100-sm margin-top-400" data-type="very-small-md">
    <div class="[ flights-not-found-grid ] [ d-grid text-align-center-sm ]">
        <picture class="justify-self-center">
            <source srcset="<?= Url::to('@web/images/flights-not-found-pc.svg') ?>" media="(min-width: 40em)">
            <img src="<?= Url::to('@web/images/flights-not-found-mobile.svg') ?>" alt="representação de erro">
        </picture>
        <div>
            <p>Infelizmente não foi encontrado nenhum resultado, no entanto, experimente vêr quais são as próximas datas disponíveis.</p>
            <a href="<?= Url::current(['src' => null, 'tryAgain' => true]) ?>" class="[ button ] [ margin-top-600 ]" data-type="secondary-outline">Vêr próximas datas</a>
        </div>
    </div>
</div>