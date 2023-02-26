<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\RestaurantItem $model */

$this->title = $model->item;

// Se estiver a ser visualizado por um admin então o breadcrumbs é diferente
if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) {
    $this->params['breadcrumbs'][] = [
        'label' => 'Restaurantes',
        'url' => ['restaurant/index'],
    ];
    $this->params['breadcrumbs'][] = [
        'label' => $model->restaurant->name,
        'url' => ['restaurant/view', 'id' => $model->restaurant->id],
    ];
}

$this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['index', 'restaurant_id' => $model->restaurant_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="restaurant-item-view">

    <div class="d-flex mb-3">
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Apagar imagem', ['delete-logo', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger ml-auto',
            'data' => [
                'confirm' => 'Tem a certeza que quer eliminar a imagem?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a('Apagar item', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende eliminar o item do menu?',
                'method' => 'post',
            ],
        ]) ?>

    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'item',
            [
                'attribute' => 'image',
                'value' => Url::to($model->getImagePathUrl()),
                'format' => ['image', ['width' => '100', 'class' => 'img-fluid']],
            ],
            [
                'attribute' => 'Estado',
                'value' => $model->getState(),
            ],
        ],
    ]) ?>

</div>