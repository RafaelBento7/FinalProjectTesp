<?php

use common\models\Manager;
use hail812\adminlte\widgets\SmallBox;
use yii\helpers\Url;

$this->title = 'Dashboard';

?>
<div class="container-fluid">
    <?php if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) : ?>
        <div class="row">
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Voos',
                    'icon' => 'fas fa-plane-departure',
                    'linkUrl' => Url::to(["/flight/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Aeroportos',
                    'icon' => 'fas fa-plane-arrival',
                    'linkUrl' => Url::to(["/airport/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Aviões',
                    'icon' => 'fas fa-plane',
                    'linkUrl' => Url::to(["/airplane/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Companhias',
                    'icon' => 'fas fa-building',
                    'linkUrl' => Url::to(["/company/index"])
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Trabalhadores',
                    'icon' => 'fas fa-user',
                    'linkUrl' => Url::to(["/employee/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Clientes',
                    'icon' => 'fas fa-user',
                    'linkUrl' => Url::to(["/client/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Perdidos e achados',
                    'icon' => 'fas fa-suitcase-rolling',
                    'linkUrl' => Url::to(["/lost-item/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Suporte ao cliente',
                    'icon' => 'fas fa-envelope',
                    'linkUrl' => Url::to(["/support-ticket/index"])
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Métodos de pagamento',

                    'icon' => 'fas fa-solid fa-credit-card',
                    'linkUrl' => Url::to(["/payment-method/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Restaurantes',
                    'icon' => 'fas fa-utensils',
                    'linkUrl' => Url::to(["/restaurant/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Lojas',
                    'icon' => 'fas fa-shopping-cart',
                    'linkUrl' => Url::to(["/store/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Server Log',
                    'icon' => 'fas fa-info',
                    'linkUrl' => Url::to(["/log-reader"])
                ]) ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['employee'])) : ?>
        <div class="row">
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Voos',
                    'icon' => 'fas fa-plane-departure',
                    'linkUrl' => Url::to(["/flight/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Aeroportos',
                    'icon' => 'fas fa-plane-arrival',
                    'linkUrl' => Url::to(["/airport/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Aviões',
                    'icon' => 'fas fa-plane',
                    'linkUrl' => Url::to(["/airplane/index"])
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Clientes',
                    'icon' => 'fas fa-user',
                    'linkUrl' => Url::to(["/client/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Perdidos e achados',
                    'icon' => 'fas fa-suitcase-rolling',
                    'linkUrl' => Url::to(["/lost-item/index"])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Suporte ao cliente',
                    'icon' => 'fas fa-envelope',
                    'linkUrl' => Url::to(["/support-ticket/index"])
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Métodos de pagamento',

                    'icon' => 'fas fa-solid fa-credit-card',
                    'linkUrl' => Url::to(["/payment-method/index"])
                ]) ?>
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>
        </div>
    <?php endif; ?>

    <?php if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['manager'])) :
        $manager = Manager::find()->where(['manager_id' => Yii::$app->user->getId()])->one(); ?>
        <div class="row">
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Restaurante',
                    'icon' => 'fas fa-utensils',
                    'linkUrl' => Url::to(["/restaurant/view?id=" . $manager->restaurant_id])
                ]) ?>
            </div>
            <div class="col">
                <?= SmallBox::widget([
                    'title' => '150',
                    'text' => 'Ementa',
                    'icon' => 'fas fa-utensils',
                    'linkUrl' => Url::to(["/restaurant-item/index?restaurant_id=" . $manager->restaurant_id])
                ]) ?>
            </div>
        </div>
    <?php endif; ?>
</div>