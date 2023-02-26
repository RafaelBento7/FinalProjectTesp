<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LostItem $model */

$this->title = 'Criar Item';
$this->params['breadcrumbs'][] = ['label' => 'Perdidos e Achados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lost-item-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>