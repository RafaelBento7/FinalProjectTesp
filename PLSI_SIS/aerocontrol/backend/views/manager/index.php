<?php

use common\models\Manager;
use common\models\Restaurant;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ManagerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gerentes de Restaurantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-index">

    <p>
        <?= Html::a('Criar gerente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => 'Nenhum resultado encontrado!',
        'columns' => [
            [
                'label' => 'Id',
                'attribute' => 'manager_id',
                'value' => 'manager_id',
            ],
            [
                'label' => 'Username',
                'attribute' => 'user_username',
                'value' => function ($model) {
                    return $model->user->username;
                }
            ],
            [
                'label' => 'Nome',
                'attribute' => 'user_fullname',
                'value' => function ($model) {
                    return $model->user->getFullName();
                }
            ],
            [
                'label' => 'Email',
                'attribute' => 'user_email',
                'value' => function ($model) {
                    return $model->user->email;
                }
            ],
            [
                'label' => 'Telefone',
                'attribute' => 'user_phone',
                'value' => function ($model) {
                    return $model->user->phone;
                }
            ],
            [
                'label' => 'Restaurante',
                'attribute' => 'restaurant_id',
                'value' => function ($model) {
                    return $model->restaurant->name;
                },
                'filter' => Restaurant::getPossibleRestaurantsForDropdowns()
            ],

            [
                'class' => ActionColumn::className(),
                'template' => '{update} {view}',
                'urlCreator' => function ($action, Manager $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'manager_id' => $model->manager_id]);
                }
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>