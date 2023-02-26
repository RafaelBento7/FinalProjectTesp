<?php

use common\models\Airport;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AirportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Aeroportos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airport-index">
    <p>
        <?= Html::a('Criar aeroporto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            'id',
            'name',
            'country',
            'city',
            [
                'label' => 'Website',
                'attribute' => 'website',
                'filter' => ''
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {view}',
                'urlCreator' => function ($action, Airport $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>