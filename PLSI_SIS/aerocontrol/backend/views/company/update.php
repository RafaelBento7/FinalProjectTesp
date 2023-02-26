<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Company $model */

$this->title = 'Atualizar Companhia: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companhias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="company-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>