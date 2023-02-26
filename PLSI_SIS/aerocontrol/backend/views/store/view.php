<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Store $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lojas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-view">

    <div class="d-flex mb-3">
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Apagar logo', ['delete-logo', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger ml-auto',
            'data' => [
                'confirm' => 'Tem a certeza que quer eliminar o logo?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a('Apagar loja', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que quer eliminar a loja?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'phone',
            'open_time',
            'close_time',
            [
                'attribute' => 'logo',
                'value' => Url::to($model->getLogoPathUrl()),
                'format' => ['image', ['width' => '100', 'class' => 'img-fluid']],
            ],
            'website',
        ],
    ]) ?>

</div>