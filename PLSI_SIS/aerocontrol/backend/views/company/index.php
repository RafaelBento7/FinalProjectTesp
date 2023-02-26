<?php

use common\models\Company;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CompanySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Companhias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">
    <p>
        <?= Html::a('Criar companhia', ['create'], ['class' => 'btn btn-success']) ?>
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
                    Company::STATE_INACTIVE => 'Inativo',
                    Company::STATE_ACTIVE => 'Ativo'
                ]
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {view}',
                'urlCreator' => function ($action, Company $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>