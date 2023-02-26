<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\components\CustomAlert;
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>


    <link rel="icon" type="image/png" sizes="32x32" href="<?= Url::to('@web/images/logo-url-icon.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="body-grid">
    <?php $this->beginBody(); ?>

    <?= $this->render('header') ?>

    <main>
        <?= CustomAlert::widget() ?>
        <?= $content ?>
    </main>

    <?= $this->render('footer') ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
