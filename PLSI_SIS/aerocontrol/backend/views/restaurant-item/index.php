<?php

use common\models\RestaurantItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\RestaurantItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var common\models\Restaurant $restaurant */

$this->title = 'Menu';

// Se estiver a ser visualizado por um admin então o breadcrumbs é diferente
if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) {
    $this->params['breadcrumbs'][] = [
        'label' => 'Restaurantes',
        'url' => ['restaurant/index'],
    ];
    $this->params['breadcrumbs'][] = [
        'label' => $restaurant->name,
        'url' => ['restaurant/view', 'id' => $restaurant->id],
    ];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-item-index">

    <p>
        <?= Html::a('Criar item', ['create', 'restaurant_id' => $restaurant->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            'id',
            'item',
            [
                'attribute' => 'image',
                'value' => function ($model) {
                    return Url::to($model->getImagePathUrl());
                },
                'format' => ['image', ['width' => '100', 'class' => 'img-fluid']],
                'filter' => '',
            ],
            [
                'attribute' => 'state',
                'value' => function ($model) {
                    return $model->getState();
                },
                'filter' => [
                    0 => 'Inativo',
                    1 => 'Ativo'
                ],
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, RestaurantItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>