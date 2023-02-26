<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProviderGo */
/** @var yii\data\ActiveDataProvider $dataProviderBack */
/** @var \common\models\FlightForm $model */
/** @var \common\models\Airport[] $airports */
/** @var bool $tryAgain */

use common\models\FlightForm;
use yii\widgets\ListView;

$this->title = "Voos";

$this->registerJsFile('@web/js/flight-search.js', [
    'type' => 'module',
]);
?>

<div class="container" data-type="small-md">
    <section class="padding-block-700">
        <h1 class="fs-500 fw-semi-bold text-align-center">Reserve agora o seu voo</h1>
        <?= $this->render('_form', [
            'airports' => $airports,
            'model' => $model
        ]) ?>
    </section>
    <div class="divider"></div>
    <section class="padding-block-700">

        <?php
        //SE IDA E DATA PROVIDER MAL -> ERRO     OU      SE IDA/VOLTA E DATAPROVIDERS MAL -> ERRO
        if (
            !$model->two_way_trip && !(isset($dataProviderGo) && $dataProviderGo->totalCount > 0) ||
            $model->two_way_trip && !(isset($dataProviderGo) && $dataProviderGo->totalCount > 0 && isset($dataProviderBack) && $dataProviderBack->totalCount > 0)
        ) {
            echo '<h2 class="fs-500 fw-semi-bold text-align-center">' . $model->destiny . ' - ' . $model->origin . '</h2>';
            if (!$tryAgain) {
                echo $this->render('search-more-flights', [
                    'model' => $model,
                ]);
            } else {
                echo $this->render('no-flights', [
                    'model' => $model,
                ]);
            }
        } else {
        ?>
            <div>
                <h2 class="fs-500 fw-semi-bold text-align-center"><?= $model->origin . ' - ' . $model->destiny ?></h2>
                <p class="fs-400 fw-semi-bold text-align-center margin-top-50"><?= $dataProviderGo->getTotalCount() ?> Resultados encontrados!</p>
                <?php         // ESCREVE A LISTVIEW DE IDA, PORQUE NÃO HOUVE ERROS
                echo ListView::widget([
                    'dataProvider' => $dataProviderGo,
                    'summary' => '',
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'margin-top-400 flow',
                        'role' => 'list',
                        'data-flow-space' => 'medium',
                        'data-flight-trip-go' => true,
                    ],
                    'emptyText' => "",
                    'itemView' => '_flight',
                    'viewParams' => ['flightType' => FlightForm::FLIGHT_TYPE_GO]
                ]);
                ?>
            </div>
            <?php
            // SE FOR IDA/VOLTA, ESCREVE A LISTVIEW DE VOLTA
            if ($model->two_way_trip) {
            ?>
                <div class="margin-top-500">
                    <h2 class="fs-500 fw-semi-bold text-align-center"><?= $model->destiny . ' - ' . $model->origin ?></h2>
                    <p class="fs-400 fw-semi-bold text-align-center margin-top-50"><?= $dataProviderBack->getTotalCount() ?> Resultados encontrados!</p>
            <?php
                echo ListView::widget([
                    'dataProvider' => $dataProviderBack,
                    'summary' => '',
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'margin-top-400 flow',
                        'role' => 'list',
                        'data-flow-space' => 'medium',
                        'data-flight-trip-back' => true,
                    ],
                    'emptyText' => "",
                    'itemView' => '_flight',
                    'viewParams' => ['flightType' => FlightForm::FLIGHT_TYPE_BACK]
                ]);
            }
        } ?>
                </div>
    </section>
</div>