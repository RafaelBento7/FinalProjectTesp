<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */

$resetLink = Yii::$app->urlManagerFrontEnd->createUrl(['site/reset-password','token' => $user->password_reset_token]);
?>
Olá <?= $user->first_name . ' ' . $user->last_name ?>,

Segue o link abaixo para repor a palavra passe:

<?= $resetLink ?>
