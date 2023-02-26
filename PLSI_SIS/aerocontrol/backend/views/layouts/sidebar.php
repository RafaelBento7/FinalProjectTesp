<?php

use common\models\Manager;
use common\models\User;
use hail812\adminlte\widgets\Menu;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= \Yii::$app->user->identity->first_name . " " . Yii::$app->user->identity->last_name ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            $sideBarMenuItems = [];
            if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin'])) {
                $sideBarMenuItems = array_merge($sideBarMenuItems, [
                    [
                        'label' => 'Aeroporto',
                        'icon' => 'fas fa-solid fa-plane',
                        'items' => [
                            ['label' => 'Voos', 'url' => ['/flight/index'], 'iconStyle' => 'far', 'icon'],
                            ['label' => 'Aeroportos', 'url' => ['/airport/index'], 'iconStyle' => 'far'],
                            ['label' => 'Aviões', 'url' => ['/airplane/index'], 'iconStyle' => 'far'],
                            ['label' => 'Companhias', 'url' => ['/company/index'], 'iconStyle' => 'far']
                        ]
                    ],
                    [
                        'label' => 'Utilizadores',
                        'icon' => 'fas fa-solid fa-user',
                        'items' => [
                            ['label' => 'Administradores', 'url' => ['/admin/index'], 'iconStyle' => 'far'],
                            ['label' => 'Trabalhadores', 'url' => ['/employee/index'], 'iconStyle' => 'far'],
                            ['label' => 'Clientes', 'url' => ['/client/index'], 'iconStyle' => 'far'],
                            ['label' => 'Funções de Trabalhador', 'url' => ['/employee-function/index'], 'iconStyle' => 'far']
                        ]
                    ],
                    [
                        'icon' => 'fas fa-solid fa-suitcase-rolling',
                        'label' => 'Perdidos e Achados',
                        'items' => [
                            ['label' => 'Itens', 'url' => ['/lost-item/index'], 'iconStyle' => 'far'],
                            ['label' => 'Suporte ao cliente', 'url' => ['/support-ticket/index'], 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Métodos de Pagamento', 'icon' => 'fas fa-solid fa-credit-card', 'url' => ['/payment-method/index']],
                    [
                        'label' => 'Restaurantes',
                        'icon' => 'fas fa-solid fa-utensils',
                        'items' => [
                            ['label' => 'Restaurantes', 'url' => ['/restaurant/index'], 'iconStyle' => 'far'],
                            ['label' => 'Gerentes', 'url' => ['/manager/index'], 'iconStyle' => 'far'],
                        ]
                    ],
                    ['label' => 'Lojas', 'url' => ['/store/index'], 'icon' => 'fas fa-solid fa-shopping-cart'],
                    ['label' => 'Server Log', 'url' => ['/log-reader'], 'icon' => 'fas fa-solid fa-info'],
                ]);
            }
            if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['manager'])) {
                $manager = Manager::find()->where(['manager_id' => Yii::$app->user->getId()])->one();
                $sideBarMenuItems = array_merge($sideBarMenuItems, [
                    ['label' => 'Restaurante', 'url' => ['/restaurant/view?id=' . $manager->restaurant_id], 'icon' => 'fas fa-house-user'],
                    ['label' => 'Ementa', 'url' => ['/restaurant-item/index?restaurant_id=' . $manager->restaurant_id], 'icon' => 'fas fa-solid fa-utensils'],
                ]);
            }
            if (isset(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['employee'])) {
                $sideBarMenuItems = array_merge($sideBarMenuItems, [
                    [
                        'label' => 'Aeroporto',
                        'icon' => 'fas fa-solid fa-plane',
                        'items' => [
                            ['label' => 'Voos', 'url' => ['/flight/index'], 'iconStyle' => 'far'],
                            ['label' => 'Aeroportos', 'url' => ['/airport/index'], 'iconStyle' => 'far'],
                            ['label' => 'Aviões', 'url' => ['/airplane/index'], 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Perdidos e Achados',
                        'icon' => 'fas fa-solid fa-suitcase-rolling',
                        'items' => [
                            ['label' => 'Itens', 'url' => ['/lost-item/index'], 'iconStyle' => 'far'],
                            ['label' => 'Suporte ao cliente', 'url' => ['/support-ticket/index'], 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Clientes', 'url' => ['/client/index'], 'icon' => 'fas fa-solid fa-user'],
                    ['label' => 'Métodos de Pagamento', 'url' => ['/payment-method/index'], 'icon' => 'fas fa-solid fa-credit-card'],
                ]);
            }

            echo Menu::widget([
                'items' => $sideBarMenuItems
            ]);

            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>