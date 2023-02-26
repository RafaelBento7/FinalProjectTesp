<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Restaurant $model */

$this->title = 'Criar Restaurante';
$this->params['breadcrumbs'][] = ['label' => 'Restaurantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
