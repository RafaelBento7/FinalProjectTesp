<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EmployeeFunction $model */

$this->title = 'Criar Função de Trabalhador';
$this->params['breadcrumbs'][] = ['label' => 'Funções de Trabalhador', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-function-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>