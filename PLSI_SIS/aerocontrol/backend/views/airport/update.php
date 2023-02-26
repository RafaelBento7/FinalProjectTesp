<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Airport $model */

$this->title = 'Atualizar Aeroporto: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Aeroportos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="airport-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
