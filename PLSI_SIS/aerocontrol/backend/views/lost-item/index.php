<?php

use common\models\LostItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\LostItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Perdidos e Achados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lost-item-index">

    <p>
        <?= Html::a('Criar item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            'id',
            'description',
            [
                'attribute' => 'state',
                'value' => function ($model) {
                    return $model->state;
                },
                'filter' => [
                    'Entregue' => 'Entregue',
                    'Por entregar' => 'Por entregar',
                    'Perdido' => 'Perdido'
                ],
            ],
            [
                'attribute' => 'image',
                'value' => function ($model) {
                    return Url::to($model->getImagePathUrl());
                },
                'format' => ['image', ['width' => '100', 'class' => 'img-fluid']],
                'filter' => '',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, LostItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>