<?php

use common\assets\CustomAlertAsset;

use yii\helpers\Url;

CustomAlertAsset::register($this);
?>

<div class="alert" data-alert-type="<?= $type ?>">
    <span aria-hidden="true">
        <svg class="icon alert__icon">
            <use xlink:href="<?= Url::to('@web/images/' . $type . '-icon.svg#' . $type) ?>"></use>
        </svg>
    </span>
    <p class="[ alert__message ] [ fs-300 letter-spacing-1 fw-bold ]"><?= $body ?></p>
    <button class="alert-toggle-btn">
        <svg class="icon alert__icon">
            <use xlink:href="<?= Url::to('@web/images/alert-close-icon.svg#alert-close-icon') ?>"></use>
        </svg>
    </button>
</div>