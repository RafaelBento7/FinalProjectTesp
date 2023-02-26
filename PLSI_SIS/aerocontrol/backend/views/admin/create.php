<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Admin $model */

$this->title = 'Criar Administrador';
$this->params['breadcrumbs'][] = ['label' => 'Administradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
