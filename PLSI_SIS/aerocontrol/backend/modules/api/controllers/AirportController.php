<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class AirportController extends ActiveController
{
    public $modelClass = 'common\models\Airport';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    protected function verbs()
    {
        return [
            'index' => ['GET'],
        ];
    }
}