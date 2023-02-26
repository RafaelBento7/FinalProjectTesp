<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */

$resetLink = Yii::$app->urlManagerFrontEnd->createUrl(['site/reset-password','token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Olá <?= Html::encode($user->first_name . ' ' . $user->last_name) ?>,</p>

    <p>Segue o link abaixo para repor a palavra passe:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
