<?php

use yii\helpers\Html;use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\User $user */

$verifyLink = Yii::$app->urlManagerFrontEnd->createUrl(['site/verify-email','token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Olá <?= Html::encode($user->first_name . ' ' . $user->last_name) ?>,</p>

    <p>Segue o link abaixo para verificar o email:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
