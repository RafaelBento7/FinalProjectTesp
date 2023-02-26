<?php

use common\models\EmployeeFunction;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\EmployeeFunction $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Funções de Trabalhador', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-function-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Nome',
                'value' => $model->name,
            ],
            [
                'label' => 'Estado',
                'value' => $model->getState(),
            ],
        ],
    ]) ?>

</div>