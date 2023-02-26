<?php

use common\models\Client;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ClientSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            'client_id',
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
                'label' => 'Indicativo do país',
                'attribute' => 'user_phone_country_code',
                'value' => function ($model) {
                    return $model->user->phone_country_code;
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
                'filter' => User::POSSIBLE_GENDERS_FOR_DROPDOWN
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {view}',
                'urlCreator' => function ($action, Client $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'client_id' => $model->client_id]);
                }
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>