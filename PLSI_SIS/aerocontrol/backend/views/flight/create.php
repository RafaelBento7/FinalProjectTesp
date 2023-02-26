<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Flight $model */

$this->title = 'Criar Voo';
$this->params['breadcrumbs'][] = ['label' => 'Voos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flight-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
