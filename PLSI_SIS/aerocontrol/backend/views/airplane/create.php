<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Airplane $model */

$this->title = 'Criar Avião';
$this->params['breadcrumbs'][] = ['label' => 'Aviões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airplane-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>