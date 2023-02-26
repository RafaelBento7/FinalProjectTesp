<?php

use yii\helpers\Url;

?>
<!-- Não existe em nenhuma data -->
<div class="container width-100-sm margin-top-400" data-type="very-small-md">
    <div class="[ flights-not-found-grid ] [ d-grid text-align-center-sm ]">
        <picture class="justify-self-center">
            <source srcset="<?= Url::to('@web/images/flights-not-found-pc.svg') ?>" media="(min-width: 40em)">
            <img src="<?= Url::to('@web/images/flights-not-found-mobile.svg') ?>" alt="representação de erro">
        </picture>
        <div>
            <p>Ups! Não existe mesmo nenhum voo, pedimos desculpa!</p>
        </div>
    </div>
</div>
