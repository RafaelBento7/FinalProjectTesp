<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Flight $model */

$this->title = 'Atualizar Voo: ' . $model->originAirport->name . " - " . $model->arrivalAirport->name;
$this->params['breadcrumbs'][] = ['label' => 'Voos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->originAirport->name . " - " . $model->arrivalAirport->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="flight-update">

    <?= $this->render('_form-update', [
        'model' => $model,
    ]) ?>

</div>