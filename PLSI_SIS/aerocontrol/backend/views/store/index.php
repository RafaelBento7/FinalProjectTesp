<?php

use common\models\Store;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\StoreSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Lojas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-index">

    <p>
        <?= Html::a('Criar loja', ['create'], ['class' => 'btn btn-success']) ?>
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
                'urlCreator' => function ($action, Store $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]) ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>