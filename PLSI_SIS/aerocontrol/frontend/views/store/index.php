<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\widgets\ListView;

$this->title = "Lojas";
?>
<section class="padding-block-700">
    <div class="container">
        <h1 class="fs-600 fw-bold text-align-center">Lojas</h1>
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
            'emptyText' => "Ainda não existem lojas",
            'emptyTextOptions' => [
                'tag' => 'p',
                'class' => 'fw-medium'
            ],
            'itemView' => '_store',
        ]);
        ?>
    </div>
</section>