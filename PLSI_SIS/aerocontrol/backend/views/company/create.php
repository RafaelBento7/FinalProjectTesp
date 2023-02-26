<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Company $model */

$this->title = 'Criar Companhia';
$this->params['breadcrumbs'][] = ['label' => 'Companhias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>