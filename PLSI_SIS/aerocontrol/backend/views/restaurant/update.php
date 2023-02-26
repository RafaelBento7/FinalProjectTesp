<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Restaurant $model */

$this->title = 'Atualizar Restaurante: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="restaurant-update">

    <?= $this->render('_form-update', [
        'model' => $model,
    ]) ?>

</div>
