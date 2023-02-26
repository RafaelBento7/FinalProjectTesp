<?php

namespace backend\modules\api\controllers;

use common\models\FlightForm;
use Yii;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\web\UnprocessableEntityHttpException;


class FlightController extends ActiveController
{
    public $modelClass = 'common\models\Flight';

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
            'search' => ['POST'],
        ];
    }

    public function actionSearch()
    {
        if (empty(Yii::$app->request->post())) throw new BadRequestHttpException('O body do request está vazio!');

        $model = new FlightForm();

        $tryAgain = $this->request->post("tryAgain");

        if ($model->load($this->request->post(), '') && $model->validate()) {
            $flightGo = $model->getDataProviderGo($tryAgain);
            if ($flightGo == null || $flightGo->totalCount == 0) {
                throw new NotFoundHttpException("Nenhum voo encontrado");
            }
            if ($model->two_way_trip) {
                $flightBack = $model->getDataProviderBack($tryAgain);
                if ($flightBack == null || $flightBack->totalCount == 0) {
                    throw new NotFoundHttpException("Nenhum voo encontrado");
                }
                return [
                    'flightsGo' => $flightGo,
                    'flightsBack' => $flightBack
                ];
            }
            return [
                'flightsGo' => $flightGo
            ];
        } else throw new UnprocessableEntityHttpException(Json::encode($model->getErrors()));
    }
}
