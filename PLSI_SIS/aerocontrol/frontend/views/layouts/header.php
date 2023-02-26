<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<header class="[ primary-header ] [ padding-block-100 bg-neutral-400 ]">
    <div class="container">
        <div class="nav-wrapper">
            <a href="<?= Url::to(['site/index']) ?>">
                <picture>
                    <source srcset="<?= Url::to('@web/images/logo-pc.svg') ?>" media="(min-width: 40em)">
                    <img src="<?= Url::to('@web/images/logo-mobile.svg') ?>" alt="Logo">
                </picture>
            </a>
            <button class="[ navbar-toggle ] [ d-none-md push-to-right ] " aria-controls="primary-navigation" aria-expanded="false">
                <img class="open-icon" src="<?= Url::to('@web/images/hamburger-icon.svg') ?>" alt="" aria-hidden="true">
                <img class="close-icon" src="<?= Url::to('@web/images/close-icon.svg') ?>" alt="" aria-hidden="true">
                <span class="visually-hidden">Menu</span>
            </button>

            <nav aria-label="Primary" class="primary-navigation" id="primary-navigation">
                <ul role="list" class="navigation-list">
                    <li class="[ primary-navigation__item ] [ push-to-right ]" <?= Yii::$app->controller->id == "site" ? 'data-type="active"' : '' ?>>
                        <?= Html::a('Home', ['site/index'], ['class' => '[ primary-navigation__link ] [ fs-300 ]']) ?>
                    </li>
                    <li class="primary-navigation__item" <?= Yii::$app->controller->id == "flight" ? 'data-type="active"' : '' ?>>
                        <?= Html::a('Voos', ['flight/index'], ['class' => '[ primary-navigation__link ] [ fs-300 ]']) ?>
                    </li>
                    <li class="primary-navigation__item" <?= Yii::$app->controller->id == "restaurant" ? 'data-type="active"' : '' ?>>
                        <?= Html::a('Restaurantes', ['restaurant/index'], ['class' => '[ primary-navigation__link ] [ fs-300 ]']) ?>
                    </li>
                    <li class="[ primary-navigation__item ] [ push-to-left ]" <?= Yii::$app->controller->id == "store" ? 'data-type="active"' : '' ?>>
                        <?= Html::a('Lojas', ['store/index'], ['class' => '[ primary-navigation__link ] [ fs-300 ]']) ?>
                    </li>
                    <?php if (Yii::$app->user->isGuest) : ?>
                        <li class="primary-navigation__item">
                            <?= Html::a('Sign up', ['site/signup'], ['class' => 'button', 'data-type' => 'primary-outline']) ?>
                        </li>
                        <li class="primary-navigation__item">
                            <?= Html::a('Login', ['site/login'], ['class' => 'button']) ?>
                        </li>
                    <?php else : ?>
                        <li class="primary-navigation__item d-flex justify-content-center">
                            <div class="dropdown " data-type="navbar">
                                <button class="dropdown-button button" data-type="primary-outline" aria-expanded="false" data-dropdown>
                                    <?= \Yii::$app->user->identity->first_name . " " . Yii::$app->user->identity->last_name ?>
                                    <span aria-hidden="true">
                                        <svg class="icon dropdown__toggle-icon">
                                            <use xlink:href="<?= Url::to("@web/images/caret.svg#caret") ?>"></use>
                                        </svg>
                                    </span>
                                </button>
                                <ul role="list" class="dropdown-menu">
                                    <li class="dropdown-menu__item">
                                        <?= Html::a('Ver Conta' . '<span aria-hidden="true" class="dropdown-link__icon">
                                                        <svg class="icon">
                                                            <use xlink:href="' . Url::to('@web/images/perfil-icon.svg#perfil-icon') . '"></use>
                                                        </svg>
                                                    </span>', ['account/profile', 'id' => Yii::$app->user->id], ['class' => '[ dropdown-menu__link ] [ text-primary-accent-400 ]']) ?>
                                    </li>
                                    <li class="dropdown-menu__item">
                                        <?= Html::a('Meus Bilhetes' . '<span aria-hidden="true" class="dropdown-link__icon">
                                                        <svg class="icon">
                                                            <use xlink:href="' . Url::to('@web/images/flight-ticket.svg#flight-ticket') . '"></use>
                                                        </svg>
                                                    </span>', ['flight-ticket/index'], ['class' => '[ dropdown-menu__link ] [ text-primary-accent-400 ]']) ?>
                                    </li>
                                    <li class="dropdown-menu__item">
                                        <?= Html::a('Meus Tickets Suporte' . '<span aria-hidden="true" class="dropdown-link__icon">
                                                        <svg class="icon">
                                                            <use xlink:href="' . Url::to('@web/images/support-ticket-icon.svg#support-ticket-icon') . '"></use>
                                                        </svg>
                                                    </span>', ['support-ticket/index'], ['class' => '[ dropdown-menu__link ] [ text-primary-accent-400 ]']) ?>
                                    </li>
                                    <li class="dropdown-menu__item">
                                        <?= Html::a(
                                            'Logout' . '<span aria-hidden="true" class="dropdown-link__icon">
                                                        <svg class="icon">
                                                            <use xlink:href="' . Url::to('@web/images/logout-icon.svg#logout-icon') . '"></use>
                                                        </svg>
                                                    </span>',
                                            ['site/logout'],
                                            [
                                                'data-method' => 'post', 'class' => 'dropdown-menu__link',
                                                'data-type' => 'logout'
                                            ]
                                        ) ?>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</header>