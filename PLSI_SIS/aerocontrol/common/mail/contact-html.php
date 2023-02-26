<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \frontend\models\ContactForm $form */

?>
<div class="verify-email">
    <p>Olá, sou o(a) <?= Html::encode($form->name) ?>,</p>

    <p><?= nl2br(Html::encode($form->body)) ?></p>
</div>
