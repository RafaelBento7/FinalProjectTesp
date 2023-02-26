<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Flight $model */

$this->title = $model->originAirport->name . " - " . $model->arrivalAirport->name;
$this->params['breadcrumbs'][] = ['label' => 'Voos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="flight-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'terminal',
            'estimated_departure_date',
            'estimated_arrival_date',
            'departure_date',
            'arrival_date',
            [
                'label' => 'Preço',
                'value' => $model->price . "€",
            ],
            [
                'label' => 'Distância',
                'value' => $model->distance . "Km",
            ],
            'state',
            [
                'label' => 'Desconto(%)',
                'value' => $model->discount_percentage . "%",
            ],
            [
                'label' => 'Aeroporto de Origem',
                'value' => $model->originAirport->name,
            ],
            [
                'label' => 'Aeroporto de Chegada',
                'value' => $model->arrivalAirport->name,
            ],
            [
                'label' => 'Avião',
                'value' => $model->airplane->name,
            ],
            'passengers_left',
        ],
    ]) ?>

</div>