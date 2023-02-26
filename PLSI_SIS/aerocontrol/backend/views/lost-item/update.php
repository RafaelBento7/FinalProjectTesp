<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LostItem $model */

$this->title = 'Atualizar Item: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Perdidos e Achados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="lost-item-update">

    <?= $this->render('_form-update', [
        'model' => $model,
    ]) ?>

</div>