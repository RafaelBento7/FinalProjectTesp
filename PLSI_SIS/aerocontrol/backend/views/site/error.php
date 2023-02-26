<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Erro";
$this->params['breadcrumbs'] = [['label' => $name]];
?>
<main>
    <div class="container padding-block-700 height-100">
        <div class="[ error-grid ] [ even-columns place-content-center text-align-center-sm height-100 ]">
            <picture>
                <source srcset="<?= Url::to('@web/images/error-icon-pc.svg') ?>" media="(min-width: 40em)">
                <img src="<?= Url::to('@web/images/error-icon-mobile.svg') ?>" alt="representação de erro">
            </picture>
            <div>
                <h1 class="fs-600 fw-bold"><?= Html::encode($name) ?></h1>
                <p class="margin-top-100"> <?= nl2br(Html::encode($message)) ?></p>
                <p>
                    O erro acima ocorreu enquanto o servidor Web estava processando a sua informação.
                </p>
                <p>
                    Entre em contacto connosco se achar que é um erro de servidor. Obrigado.
                </p>
            </div>
        </div>
    </div>
</main>