<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EmployeeFunction $model */

$this->title = 'Editar Função de Trabalhador: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Funções de Trabalhador', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="employee-function-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>