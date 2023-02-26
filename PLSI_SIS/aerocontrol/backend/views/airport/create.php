<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Airport $model */

$this->title = 'Criar Aeroporto';
$this->params['breadcrumbs'][] = ['label' => 'Aeroportos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airport-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
