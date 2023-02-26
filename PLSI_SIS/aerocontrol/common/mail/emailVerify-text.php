<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */

$verifyLink = Yii::$app->urlManagerFrontEnd->createUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Olá <?= $user->first_name . ' ' . $user->last_name ?>

Segue o link abaixo para verificar o email:

<?= $verifyLink ?>