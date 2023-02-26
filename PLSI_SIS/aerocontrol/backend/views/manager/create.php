<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Manager $model */

$this->title = 'Criar Gerente';
$this->params['breadcrumbs'][] = ['label' => 'Gerentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
