<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Store $model */

$this->title = 'Atualizar Loja: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lojas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="store-update">

    <?= $this->render('_form-update', [
        'model' => $model,
    ]) ?>

</div>
