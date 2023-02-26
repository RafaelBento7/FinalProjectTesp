<?php

use common\models\Airplane;
use common\models\Company;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AirplaneSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Aviões';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airplane-index">
    <p>
        <?= Html::a('Criar avião', ['create'], ['class' => 'btn btn-success']) ?>
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
            'capacity',
            [
                'label' => 'Estado',
                'attribute' => 'state',
                'value' => function ($model) {
                    return $model->getState();
                },
                'filter' => [
                    Airplane::STATE_INACTIVE => 'Inativo',
                    Airplane::STATE_ACTIVE => 'Ativo'
                ],
            ],
            [
                'label' => 'Companhia',
                'attribute' => 'company_id',
                'value' => function ($model) {
                    return $model->company->name;
                },
                'filter' => Company::getPossibleCompaniesForDropdowns(),
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {view}',
                'urlCreator' => function ($action, Airplane $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>