<?php

use common\models\Airplane;
use common\models\Flight;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

/** @var yii\web\View $this */
/** @var common\models\FlightSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Voos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flight-index">

    <p>
        <?= Html::a('Criar voo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => 'Nenhum resultado encontrado!',
        'columns' => [
            'id',
            [
                'label' => 'Origem - Data de Partida Estimada',
                'value' => function ($model) {
                    return $model->originAirport->name . " - " . $model->estimated_departure_date;
                },
            ],
            [
                'label' => 'Destino - Data de Chegada Estimada',
                'value' => function ($model) {
                    return $model->arrivalAirport->name . ' - ' . $model->estimated_arrival_date;
                },
            ],
            'terminal',
            [
                'attribute' => 'departure_date',
                'filter' => false
            ],
            [
                'attribute' => 'arrival_date',
                'filter' => false
            ],
            [
                'label' => 'Avião',
                'attribute' => 'airplane_id',
                'value' => function ($model) {
                    return $model->airplane->name;
                },
                'filter' => ArrayHelper::map(Airplane::find()->asArray()->all(), 'id', 'name'),
            ],
            [
                'attribute' => 'state',
                'filter' => Flight::POSSIBLE_STATES_FOR_DROPDOWN,
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {view}',
                'urlCreator' => function ($action, Flight $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>