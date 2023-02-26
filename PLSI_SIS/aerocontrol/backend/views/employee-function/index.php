<?php

use common\models\EmployeeFunction;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\EmployeeFunctionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Funções de Trabalhador';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-function-index">
    <p>
        <?= Html::a('Criar função', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'label' => 'Estado',
                'attribute' => 'state',
                'value' => function ($model) {
                    return $model->getState();
                },
                'filter' => [
                    EmployeeFunction::STATE_INACTIVE => 'Inativo',
                    EmployeeFunction::STATE_ACTIVE => 'Ativo'
                ],
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {view}',
                'urlCreator' => function ($action, EmployeeFunction $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>


</div>