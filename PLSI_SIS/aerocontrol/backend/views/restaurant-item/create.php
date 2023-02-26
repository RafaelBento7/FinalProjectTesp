<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RestaurantItem $model */

$this->title = 'Criar Item';

// Se estiver a ser visualizado por um admin então o breadcrumbs é diferente
if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) {
    $this->params['breadcrumbs'][] = [
        'label' => 'Restaurantes',
        'url' => ['restaurant/index'],
    ];
    $this->params['breadcrumbs'][] = [
        'label' => $model->restaurant->name,
        'url' => ['restaurant/view', 'id' => $model->restaurant->id],
    ];
}

$this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['index', 'restaurant_id' => $model->restaurant_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-item-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>