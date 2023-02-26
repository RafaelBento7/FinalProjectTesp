<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Manager $model */

$this->title = 'Atualizar Gerente: ' . $model->user->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Gerentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->getFullName(), 'url' => ['view', 'manager_id' => $model->manager_id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="manager-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>