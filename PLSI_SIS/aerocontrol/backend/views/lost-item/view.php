<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\LostItem $model */

$this->title = 'Item Nº ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Perdidos e achados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lost-item-view">

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
                'confirm' => 'Tem a certeza que quer eliminar o item dos perdidos e achados?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'description',
            'state',
            [
                'attribute' => 'image',
                'value' => Url::to($model->getImagePathUrl()),
                'format' => ['image', ['width' => '100', 'class' => 'img-fluid']],
            ],
        ],
    ]) ?>

</div>