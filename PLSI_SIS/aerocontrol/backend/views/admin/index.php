<?php

use common\models\Admin;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AdminSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Administradores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <p>
        <?= Html::a('Criar administrador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            [
                'label' => 'ID',
                'attribute' => 'admin_id',
                'value' => 'admin_id'
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
                'label' => 'Género',
                'attribute' => 'user_gender',
                'value' => function ($model) {
                    return $model->user->gender;
                },
                'filter' => User::POSSIBLE_GENDERS_FOR_DROPDOWN,
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {view}',
                'urlCreator' => function ($action, Admin $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'admin_id' => $model->admin_id]);
                }
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>