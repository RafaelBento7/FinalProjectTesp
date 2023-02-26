<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Admin $model */

$this->title = 'Atualizar Administrador: ' . $model->user->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Administrador', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->getFullName(), 'url' => ['view', 'admin_id' => $model->admin_id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="admin-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>