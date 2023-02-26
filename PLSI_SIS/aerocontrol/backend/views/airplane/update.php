<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Airplane $model */

$this->title = 'Atualizar Avião: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Aviões', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="airplane-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>