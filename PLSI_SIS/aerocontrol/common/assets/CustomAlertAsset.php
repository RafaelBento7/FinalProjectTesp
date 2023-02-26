<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Custom Alert asset bundle.
 */
class CustomAlertAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/alert.js'
    ];
}
