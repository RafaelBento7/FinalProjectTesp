<?php

namespace frontend\controllers;

use common\models\Airport;
use common\models\Flight;
use common\models\FlightForm;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * FlightController implements the CRUD actions for Flight model.
 */
class FlightController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Flight models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new FlightForm();
        $airports = Airport::find()->all();
        $model->loadDefaultValues();

        return $this->render('index', [
            'airports' => $airports,
            'model' => $model,
        ]);
    }

    public function actionSearch()
    {
        $airports = Airport::find()->all();
        $model = new FlightForm();

        $dataProviderGo = null;
        $dataProviderBack = null;

        $tryAgain = $this->request->get("tryAgain");

        if ($this->request->isGet) {
            if ($model->load($this->request->get()) && $model->validate()) {
                $dataProviderGo = $model->getDataProviderGo($tryAgain);
                if ($model->two_way_trip) {
                    $dataProviderBack = $model->getDataProviderBack($tryAgain);
                }
            } else $model->loadDefaultValues();
        }



        return $this->render('search', [
            'airports' => $airports,
            'dataProviderGo' => $dataProviderGo,
            'dataProviderBack' => $dataProviderBack,
            'model' => $model,
            'tryAgain' => $tryAgain,
        ]);
    }

    /**
     * Finds the Flight model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Flight the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Flight::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
