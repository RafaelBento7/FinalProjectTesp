<?php

/** @var yii\web\View $this */
/** @var common\models\Store $model */

$this->title = 'Criar Loja';
$this->params['breadcrumbs'][] = ['label' => 'Loja', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
