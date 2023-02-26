<?php

use common\models\Restaurant;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\RestaurantSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Restaurantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-index">


    <p>
        <?= Html::a('Criar restaurante', ['create'], ['class' => 'btn btn-success']) ?>
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
            'phone',
            'open_time',
            'close_time',
            'website',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Restaurant $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]) ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>