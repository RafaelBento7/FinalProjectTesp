<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Company $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companhias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">
    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Id',
                'value' => $model->id,
            ],
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