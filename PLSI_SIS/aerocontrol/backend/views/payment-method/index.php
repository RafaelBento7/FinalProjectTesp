<?php

use common\models\PaymentMethod;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\PaymentMethodSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Métodos de Pagamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-method-index">

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => 'Nenhum resultado encontrado!',

        'columns' => [
            'id',
            'name',
            [
                'label' => 'Estado',
                'attribute' => 'state',

                'value' => function ($model) {
                    return $model->getState();
                },
                'filter' => [
                    PaymentMethod::STATE_INACTIVE => 'Inativo',
                    PaymentMethod::STATE_ACTIVE => 'Ativo'
                ],
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        if ($model->state == PaymentMethod::STATE_ACTIVE)
                            return Html::a('Desativar', ['update', 'id' => $model->id], ['class' => 'btn btn-danger']);
                        else
                            return Html::a('Ativar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']);
                    },
                ],
            ],
        ],
    ]); ?>


</div>