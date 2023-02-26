<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = "Restaurantes";
?>
<section class="padding-block-700">
    <div class="container">
        <h1 class="fs-600 fw-bold text-align-center">Restaurantes</h1>
        <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'options' => [
                'tag' => 'ul',
                'class' => 'margin-top-500 d-grid grid-auto-fit',
                'role' => 'list',
                'data-item-size' => 'medium',
            ],
            'emptyText' => "Ainda não existem restaurantes",
            'emptyTextOptions' => [
                'tag' => 'p',
                'class' => 'fw-medium'
            ],
            'itemView' => '_restaurant',
        ]);
        ?>
    </div>
</section>