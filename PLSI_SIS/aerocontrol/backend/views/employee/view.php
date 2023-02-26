<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Employee $model */

$this->title = $model->user->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Trabalhadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <div class="d-flex mb-3">
        <?= Html::a('Atualizar', ['update', 'employee_id' => $model->employee_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'employee_id' => $model->employee_id], [
            'class' => 'btn btn-danger ml-auto',
            'data' => [
                'confirm' => 'Tem a certeza que quer eliminar o trabalhador?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'num_emp',
                'value' => $model->num_emp,
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
                'label' => 'Nº Contribuinte',
                'value' => $model->tin,
            ],
            [
                'label' => 'Nº Segurança Social',
                'value' => $model->ssn,
            ],
            [
                'label' => 'IBan',
                'value' => $model->iban,
            ],
            [
                'label' => 'Qualificações',
                'value' => $model->qualifications,
            ],
            [
                'label' => 'Função',
                'value' => $model->function->name,
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
                'label' => 'Rua',
                'value' => $model->street,
            ],
            [
                'label' => 'Código Postal',
                'value' => $model->zip_code,
            ],
            [
                'label' => 'Data de Nascimento',
                'value' => $model->user->birthdate,
            ],
        ],
    ]) ?>

</div>