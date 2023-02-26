<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Employee $model */

$this->title = 'Atualizar Trabalhador: ' . $model->user->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Trabalhadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->getFullName(), 'url' => ['view', 'employee_id' => $model->employee_id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="employee-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>