<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Manager $model */

$this->title = $model->user->first_name . " " . $model->user->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Gerentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="manager-view">

    <div class="d-flex mb-3">
        <?= Html::a('Atualizar', ['update', 'manager_id' => $model->manager_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'manager_id' => $model->manager_id], [
            'class' => 'btn btn-danger ml-auto',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'ID',
                'value' => $model->manager_id,
            ],
            [
                'label' => 'Restaurante',
                'value' => $model->restaurant->name,
            ],
            [
                'label' => 'Username',
                'value' => $model->user->username,
            ],
            [
                'label' => 'Nome',
                'value' => $model->user->first_name . " " . $model->user->last_name,
            ],
            [
                'label' => 'Email',
                'value' => $model->user->email,
            ],
            [
                'label' => 'Telefone',
                'value' => $model->user->phone_country_code . " " . $model->user->phone,
            ],
            [
                'label' => 'Género',
                'value' => $model->user->gender,
            ],
            [
                'label' => 'País',
                'value' => $model->user->country,
            ],
            [
                'label' => 'Cidade',
                'value' => $model->user->city,
            ],
            [
                'label' => 'Data de Nascimento',
                'value' => $model->user->birthdate,
            ],
        ],
    ]) ?>

</div>