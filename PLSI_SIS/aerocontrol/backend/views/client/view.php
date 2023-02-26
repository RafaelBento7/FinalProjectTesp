<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Client $model */

$this->title = $model->user->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'client_id' => $model->client_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'ID',
                'value' => $model->client_id,
            ],
            [
                'label' => 'Username',
                'value' => $model->user->username,
            ],
            [
                'label' => 'Nome',
                'value' => $model->user->getFullName(),
            ],
            [
                'label' => 'Email',
                'value' => $model->user->email,
            ],
            [
                'label' => 'Telefone',
                'value' => $model->user->getFullPhone(),
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