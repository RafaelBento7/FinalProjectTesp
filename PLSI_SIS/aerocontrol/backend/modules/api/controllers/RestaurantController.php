<?php

namespace backend\modules\api\controllers;

use common\models\RestaurantItem;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class RestaurantController extends ActiveController
{
    public $modelClass = 'common\models\Restaurant';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
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

    public function actionIndex()
    {
        $restaurants = new $this->modelClass;
        $allRestaurants = $restaurants::find()->all();

        foreach ($allRestaurants as $restaurant) {
            $restaurant->menu = $restaurant->restaurantItems;
        }
        return $allRestaurants;
    }
}
