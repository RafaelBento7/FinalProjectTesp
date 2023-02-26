<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Airplane $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Aviões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="airplane-view">

    <div class="d-flex mb-3">
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Nome',
                'value' => $model->name,
            ],
            [
                'label' => 'Capacidade',
                'value' => $model->capacity,
            ],
            [
                'label' => 'Estado',
                'value' => $model->getState(),
            ],
            [
                'label' => 'Companhia',
                'value' => $model->company->name,
            ],
        ],
    ]) ?>

</div>